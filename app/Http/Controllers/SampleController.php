<?php

namespace App\Http\Controllers;

use App\Models\Accreditedsamplingstatus;
use App\Models\Laboratory;
use App\Models\Sample;
use App\Models\Sampler;
use App\Models\Samplingreason;
use App\Models\Samplingsite;
use Illuminate\Http\Request;
use App\Models\Humvimodule;
use App\Models\Humviresponsible;
use App\Models\Result;
use App\Models\Samplingtype;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $humvimodules = Humvimodule::all();
        $humviresponsibles = Humviresponsible::all();
        $samplingtypes = Samplingtype::all();
        $laboratories = Laboratory::all();
        $samplers = Sampler::all();
        $samplingsites = Samplingsite::all();
        $accreditedsamplingstatuses = Accreditedsamplingstatus::all();
        $samplingreasons = Samplingreason::all();

        $currentPage = $request->input('page', 1);
        $items = Sample::paginate(config('constants.PAGINATED_RECORDS'))->appends(['page' => $currentPage]);
        return view('samples.index', compact('items','humvimodules', 'humviresponsibles', 'samplingtypes', 'laboratories', 'samplingsites', 'samplers', 'accreditedsamplingstatuses', 'samplingreasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $humvimodules = Humvimodule::all();
        $humviresponsibles = Humviresponsible::all();
        $samplingtypes = Samplingtype::all();
        $laboratories = Laboratory::all();
        $samplers = Sampler::all();
        $samplingsites = Samplingsite::all();
        $accreditedsamplingstatuses = Accreditedsamplingstatus::all();
        $samplingreasons = Samplingreason::all();

        $currentPage = $request->input('page', 1);

        return view('samples.create', compact('currentPage','humvimodules', 'humviresponsibles', 'samplingtypes', 'laboratories', 'samplingsites', 'samplers', 'accreditedsamplingstatuses', 'samplingreasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'sample_lab_id' => 'required|max:25',
                'humvimodule_id' => 'required|exists:humvimodules,id',
                'humviresponsible_id' => 'required|exists:humviresponsibles,id',
                'samplingtype_id' => 'required|exists:samplingtypes,id',
                'date_sampling' => 'required|date',
                'laboratory_id' => 'required|exists:laboratories,id',
                'date_samplereceipt' => 'nullable|date',
                'date_analyses_start' => 'nullable|date',
                'date_analyses_end' => 'nullable|date',
                'samplingreason_id' => 'required|exists:samplingreasons,id',
                'sampling_reason_details' => 'nullable|max:255',
                'samplingsite_id' => 'required|exists:samplingsites,id',
                'sampling_site_details' => 'nullable|max:255',
                'accreditedsamplingstatus_id' => 'nullable|exists:accreditedsamplingstatuses,id',
                'sampler_id' => 'nullable|exists:samplers,id',
                'humvi_export' => 'nullable|boolean'],
            [
                'sample_lab_id.required' => 'A laborkód mező kitöltése kötelező!',
                'sample_lab_id.max' => 'A laborkód nem lehet hosszabb, mint 25 karakter.',
                'humvimodule_id.required' => 'Modulkód megadása kötelező!',
                'humvimodule_id.exists' => 'Érvénytelen modulkód.',
                'humviresponsible_id.required' => 'Felelős megadása kötelező!',
                'humviresponsible_id.exists' => 'Érvénytelen felelős.',
                'samplingtype_id.required' => 'Mintavétel típus megadása kötelező!',
                'samplingtype_id.exists' => 'Érvénytelen mintavétel típus.',
                'date_sampling.required' => 'Mintavétel dátumának megadása kötelező!',
                'date_sampling.date' => 'Érvénytelen dátum adat.',
                'laboratory_id.required' => 'Vizsgálólaboratórium megadása kötelező!',
                'laboratory_id.exists' => 'Érvénytelen vizsgálólaboratórium.',
                'date_samplereceipt.date' => 'Érvénytelen dátum adat.',
                'date_analyses_start.date' => 'Érvénytelen dátum adat.',
                'date_analyses_end.date' => 'Érvénytelen dátum adat.',
                'samplingreason_id.required' => 'Mintavétel okának megadása kötelező!',
                'samplingreason_id.exists' => 'Érvénytelen mintavételi ok.',
                'sampling_reason_details.max' => 'A mintavétel oka nem lehet hosszabb, mint 255 karakter.',
                'samplingsite_id.required' => 'Mintavételi hely kód megadása kötelező!',
                'samplingsite_id.exists' => 'Érvénytelen mintavételi hely kód.',
                'sampling_site_details.max' => 'A mintavétel hely nem lehet hosszabb, mint 255 karakter.',
                'accreditedsamplingstatus_id.exists' => 'Érvénytelen státusz',
                'sampler_id.exists' => 'Érvénytelen mintavevő',
                'humvi_export.required' => 'Exportálás státuszának megadása kötelező!',
            ]);

        Sample::create([
            'sample_lab_id' => $validated['sample_lab_id'],
            'humvimodule_id' => $validated['humvimodule_id'],
            'humviresponsible_id' => $validated['humviresponsible_id'],
            'samplingtype_id' => $validated['samplingtype_id'],
            'date_sampling' => $validated['date_sampling'],
            'laboratory_id' => $validated['laboratory_id'],
            'date_samplereceipt' => $validated['date_samplereceipt'],
            'date_analyses_start' => $validated['date_analyses_start'],
            'date_analyses_end' => $validated['date_analyses_end'],
            'samplingreason_id' => $validated['samplingreason_id'],
            'sampling_reason_details' => $validated['sampling_reason_details'],
            'samplingsite_id' => $validated['samplingsite_id'],
            'sampling_site_details' => $validated['sampling_site_details'],
            'accreditedsamplingstatus_id' => $validated['accreditedsamplingstatus_id'],
            'sampler_id' => $validated['sampler_id'],
            'humvi_export' => $validated['humvi_export'],
        ]);

        $totalRecords = Sample::count();
        $lastPage = ceil($totalRecords / config('constants.PAGINATED_RECORDS'));

        return redirect()->route('samples.index', ['page' => $lastPage])
            ->with('success', 'Rekord sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $item=Sample::findOrFail($id);;

        $humvimodules = Humvimodule::all();
        $humviresponsibles = Humviresponsible::all();
        $samplingtypes = Samplingtype::all();
        $laboratories = Laboratory::all();
        $samplers = Sampler::all();
        $samplingsites = Samplingsite::all();
        $accreditedsamplingstatuses = Accreditedsamplingstatus::all();
        $samplingreasons = Samplingreason::all();

        $results = Result::where('sample_id', $id)->get();

        $currentPage = $request->input('page', 1);

        return view('samples.show', compact('item','results','currentPage', 'humvimodules', 'humviresponsibles', 'samplingtypes', 'laboratories', 'samplingsites', 'samplers', 'accreditedsamplingstatuses', 'samplingreasons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $item=Sample::findOrFail($id);

        $humvimodules = Humvimodule::all();
        $humviresponsibles = Humviresponsible::all();
        $samplingtypes = Samplingtype::all();
        $laboratories = Laboratory::all();
        $samplers = Sampler::all();
        $samplingsites = Samplingsite::all();
        $accreditedsamplingstatuses = Accreditedsamplingstatus::all();
        $samplingreasons = Samplingreason::all();

        $currentPage = $request->input('page', 1);

        return view('samples.edit', compact('item','currentPage', 'humvimodules', 'humviresponsibles', 'samplingtypes', 'laboratories', 'samplingsites', 'samplers', 'accreditedsamplingstatuses', 'samplingreasons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sample $sample)
    {
        $currentPage = $request->input('page', 1);

        /*ITT NINCS UNIQUE MEZŐ. UGYANAZ MINT CREATE VALIDÁLÁS. FORM REQUEST????*/
        $validated = $request->validate(
            [
                'sample_lab_id' => 'required|max:25',
                'humvimodule_id' => 'required|exists:humvimodules,id',
                'humviresponsible_id' => 'required|exists:humviresponsibles,id',
                'samplingtype_id' => 'required|exists:samplingtypes,id',
                'date_sampling' => 'required|date',
                'laboratory_id' => 'required|exists:laboratories,id',
                'date_samplereceipt' => 'nullable|date',
                'date_analyses_start' => 'nullable|date',
                'date_analyses_end' => 'nullable|date',
                'samplingreason_id' => 'required|exists:samplingreasons,id',
                'sampling_reason_details' => 'nullable|max:255',
                'samplingsite_id' => 'required|exists:samplingsites,id',
                'sampling_site_details' => 'nullable|max:255',
                'accreditedsamplingstatus_id' => 'nullable|exists:accreditedsamplingstatuses,id',
                'sampler_id' => 'nullable|exists:samplers,id',
                'humvi_export' => 'nullable|boolean'],
            [
                'sample_lab_id.required' => 'A laborkód mező kitöltése kötelező!',
                'sample_lab_id.max' => 'A laborkód nem lehet hosszabb, mint 25 karakter.',
                'humvimodule_id.required' => 'Modulkód megadása kötelező!',
                'humvimodule_id.exists' => 'Érvénytelen modulkód.',
                'humviresponsible_id.required' => 'Felelős megadása kötelező!',
                'humviresponsible_id.exists' => 'Érvénytelen felelős.',
                'samplingtype_id.required' => 'Mintavétel típus megadása kötelező!',
                'samplingtype_id.exists' => 'Érvénytelen mintavétel típus.',
                'date_sampling.required' => 'Mintavétel dátumának megadása kötelező!',
                'date_sampling.date' => 'Érvénytelen dátum adat.',
                'laboratory_id.required' => 'Vizsgálólaboratórium megadása kötelező!',
                'laboratory_id.exists' => 'Érvénytelen vizsgálólaboratórium.',
                'date_samplereceipt.date' => 'Érvénytelen dátum adat.',
                'date_analyses_start.date' => 'Érvénytelen dátum adat.',
                'date_analyses_end.date' => 'Érvénytelen dátum adat.',
                'samplingreason_id.required' => 'Mintavétel okának megadása kötelező!',
                'samplingreason_id.exists' => 'Érvénytelen mintavételi ok.',
                'sampling_reason_details.max' => 'A mintavétel oka nem lehet hosszabb, mint 255 karakter.',
                'samplingsite_id.required' => 'Mintavételi hely kód megadása kötelező!',
                'samplingsite_id.exists' => 'Érvénytelen mintavételi hely kód.',
                'sampling_site_details.max' => 'A mintavétel hely nem lehet hosszabb, mint 255 karakter.',
                'accreditedsamplingstatus_id.exists' => 'Érvénytelen státusz',
                'sampler_id.exists' => 'Érvénytelen mintavevő',
                'humvi_export.required' => 'Exportálás státuszának megadása kötelező!',
            ]);

        $sample->update($validated);

        return redirect()->route('samples.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Sample $sample)
    {
        $currentPage = $request->input('page', 1);

        $sample->delete();

        $items = Sample::paginate(config('constants.PAGINATED_RECORDS'));

        if ($currentPage > 1 && $items->count() == 0) {
            $currentPage--;  // Ha nincs rekord az oldalon, akkor visszalépünk az előző oldalra
        }

        return redirect()->route('samples.index', ['page' => $currentPage])
            ->with('success', 'Rekord sikeresen törölve!');

    }

}
