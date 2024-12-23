<?php

namespace App\Http\Controllers;

use App\Models\Accreditedsamplingstatus;
use App\Models\Sample;
use Illuminate\Http\Request;

class AccreditedSamplingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $items = Accreditedsamplingstatus::paginate(env('PAGINATED_RECORDS'))->appends(['page' => $currentPage]);
        return view('accreditedsamplingstatuses.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $currentPage = $request->input('page', 1);
        return view('accreditedsamplingstatuses.create',compact('currentPage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|unique:accreditedsamplingstatuses|max:10',
            'description' => 'required|max:50',
        ], [
            'status.required' => 'A mintavétel státusza mező kitöltése kötelező!',
            'status.max' => 'A mintavétel státusza nem lehet hosszabb, mint 10 karakter.',
            'status.unique' => 'A mintavétel státusza nem egyedi érték!',
            'description.required' => 'A leírás mező kitöltése kötelező!',
            'description.max' => 'A leírás nem lehet hosszabb, mint 50 karakter.',
        ]);

        Accreditedsamplingstatus::create([
            'status' => $validated['status'],
            'description' => $validated['description'],
        ]);

        $totalRecords = Accreditedsamplingstatus::count();
        $lastPage = ceil($totalRecords / env('PAGINATED_RECORDS'));

        return redirect()->route('accreditedsamplingstatuses.index', ['page' => $lastPage])
            ->with('success', 'Rekord sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $item=Accreditedsamplingstatus::findOrFail($id);;
        $currentPage = $request->input('page', 1);
        return view('accreditedsamplingstatuses.show', compact('item','currentPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $item=Accreditedsamplingstatus::findOrFail($id);
        $currentPage = $request->input('page', 1);
        return view('accreditedsamplingstatuses.edit', compact('item','currentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accreditedsamplingstatus $accreditedsamplingstatus)
    {
        $currentPage = $request->input('page', 1);

        $validated = $request->validate([
            'status' => 'required|unique:accreditedsamplingstatuses,status,'.$accreditedsamplingstatus->id.'|max:10',
            'description' => 'required|max:50',
        ], [
            'status.required' => 'A mintavétel státusza mező kitöltése kötelező!',
            'status.max' => 'A mintavétel státusza nem lehet hosszabb, mint 10 karakter.',
            'status.unique' => 'A mintavétel státusza nem egyedi érték!',
            'description.required' => 'A leírás mező kitöltése kötelező!',
            'description.max' => 'A leírás nem lehet hosszabb, mint 50 karakter.',
        ]);

        $accreditedsamplingstatus->update($validated);

        return redirect()->route('accreditedsamplingstatuses.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Accreditedsamplingstatus $accreditedsamplingstatus)
    {

        $sampleExists = Sample::where('accreditedsamplingstatus_id', $accreditedsamplingstatus->id)->exists();
        $currentPage = $request->input('page', 1);

        if ($sampleExists) {
            return redirect()->route('accreditedsamplingstatuses.index', ['page' => $currentPage])
            ->with('danger', 'Sikertelen törlés! Rekorhoz tartozó idegen kulcs létezik a minta táblában.');
        }

        $accreditedsamplingstatus->delete();

        $items = Accreditedsamplingstatus::paginate(env('PAGINATED_RECORDS'));

        if ($currentPage > 1 && $items->count() == 0) {
            $currentPage--;  // Ha nincs rekord az oldalon, akkor visszalépünk az előző oldalra
        }

        return redirect()->route('accreditedsamplingstatuses.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen törölve!');

    }
}
