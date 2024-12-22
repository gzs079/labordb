<?php

namespace App\Http\Controllers;

use App\Models\Humviresponsible;
use Illuminate\Http\Request;

class HumviResponsibleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $items = Humviresponsible::paginate(env('PAGINATED_RECORDS'))->appends(['page' => $currentPage]);
        return view('humviresponsibles.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $currentPage = $request->input('page', 1);
        return view('humviresponsibles.create',compact('currentPage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'responsible' => 'required|unique:humviresponsibles|max:10',
            'name' => 'required|max:150',
            'address' => 'required|max:150'
        ], [
            'responsible.required' => 'A felelős mező kitöltése kötelező!',
            'responsible.max' => 'A felelős nem lehet hosszabb, mint 10 karakter.',
            'responsible.unique' => 'A felelős nem egyedi érték!',
            'name.required' => 'A név mező kitöltése kötelező!',
            'name.max' => 'A név nem lehet hosszabb, mint 150 karakter.',
            'address.required' => 'A cím mező kitöltése kötelező!',
            'address.max' => 'A cím nem lehet hosszabb, mint 150 karakter.'
        ]);

        Humviresponsible::create([
            'responsible' => $validated['responsible'],
            'name' => $validated['name'],
            'address' => $validated['address'],
        ]);

        $totalRecords = Humviresponsible::count();
        $lastPage = ceil($totalRecords / env('PAGINATED_RECORDS'));

        return redirect()->route('humviresponsibles.index', ['page' => $lastPage])
            ->with('success', 'Rekord sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $item=Humviresponsible::findOrFail($id);;
        $currentPage = $request->input('page', 1);
        return view('humviresponsibles.show', compact('item','currentPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $item=Humviresponsible::findOrFail($id);
        $currentPage = $request->input('page', 1);
        return view('humviresponsibles.edit', compact('item','currentPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Humviresponsible $humviresponsible)
    {

        $currentPage = $request->input('page', 1);

        $validated = $request->validate([
            'responsible' => 'required|unique:humviresponsibles,responsible,'.$humviresponsible->id.'|max:10',
            'name' => 'required|max:150',
            'address' => 'required|max:150'
        ], [
            'responsible.required' => 'A felelős mező kitöltése kötelező!',
            'responsible.max' => 'A felelős nem lehet hosszabb, mint 10 karakter.',
            'responsible.unique' => 'A felelős nem egyedi érték!',
            'name.required' => 'A név mező kitöltése kötelező!',
            'name.max' => 'A név nem lehet hosszabb, mint 150 karakter.',
            'address.required' => 'A cím mező kitöltése kötelező!',
            'address.max' => 'A cím nem lehet hosszabb, mint 150 karakter.'
        ]);

        $humviresponsible->update($validated);

        return redirect()->route('humviresponsibles.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Humviresponsible $humviresponsible)
    {
        $currentPage = $request->input('page', 1);

        $humviresponsible->delete();

        $items = Humviresponsible::paginate(env('PAGINATED_RECORDS'));

        if ($currentPage > 1 && $items->count() == 0) {
            $currentPage--;  // Ha nincs rekord az oldalon, akkor visszalépünk az előző oldalra
        }

        return redirect()->route('humviresponsibles.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen törölve!');

    }
}
