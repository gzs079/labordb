<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\Result;
use App\Models\Sample;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        //az INDEX nézetet a sample.show nézet valósítja meg
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {

        $parameters = Parameter::all();
        $units = Unit::all();

        $sample = $request->input('sample');;
        $currentPage = $request->input('page', 1);

        return view('results.create', compact('currentPage','sample', 'parameters', 'units'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $sample_id = $request->sample_id;

        $validated = $request->validate(
            [
                'sample_id' => 'required|exists:samples,id',
                'parameter_id' => [
                    'required',
                    'exists:parameters,id',
                    Rule::unique('results','parameter_id')->where('sample_id', $sample_id) ],
                'unit_id' => 'required|exists:units,id',
                'value' => 'required|max:25',
            ],
            [
                'sample_id.required' => 'A laborkód mező kitöltése kötelező!',
                'sample_id.exists' => 'Érvénytelen mintakód.',
                'parameter_id.required' => 'A paraméter mező kitöltése kötelező!',
                'parameter_id.exists' => 'Érvénytelen paraméterkód.',
                'parameter_id.unique' => 'Ez a paraméter már korábban rögzítésre került!',
                'unit_id.required' => 'A mértékegység mező kitöltése kötelező!',
                'unit_id.exists' => 'Érvénytelen mértékegységkód.',
                'value.required' => 'Az érték mező kitöltése kötelező!',
                'value.max' => 'A érték nem lehet hosszabb, mint 25 karakter.',
            ]);

        Result::create([
            'sample_id' => $validated['sample_id'],
            'parameter_id' => $validated['parameter_id'],
            'unit_id' => $validated['unit_id'],
            'value' => $validated['value'],
            'loq' => calculate_loq($validated['value']),
            'maxrange' => calculate_maxrange($validated['value']),
            'valueassigned' => calculate_valueassigned($validated['value']),
        ]);

        $item = Sample::findOrFail($sample_id);
        $results = Result::where('sample_id', $sample_id)->get();
        $currentPage = $request->input('page', 1);

        return view('samples.show', compact('item', 'results', 'currentPage'));

    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request) {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request) {

        $item=Result::findOrFail($id);

        $parameters = Parameter::all();
        $units = Unit::all();

        $sample = Sample::findOrFail($item->sample_id);
        $currentPage = $request->input('page', 1);

        return view('results.edit', compact('item', 'sample', 'currentPage', 'parameters', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result) {

        $sample_id = $request->sample_id;

        $validated = $request->validate(
            [
                'sample_id' => 'required|exists:samples,id',
                'parameter_id' => [
                    'required',
                    'exists:parameters,id',
                    Rule::unique('results','parameter_id')->where('sample_id', $sample_id)->ignore($result->id) ],
                'unit_id' => 'required|exists:units,id',
                'value' => 'required|max:25',
            ],
            [
                'sample_id.required' => 'A laborkód mező kitöltése kötelező!',
                'sample_id.exists' => 'Érvénytelen mintakód.',
                'parameter_id.required' => 'A paraméter mező kitöltése kötelező!',
                'parameter_id.exists' => 'Érvénytelen paraméterkód.',
                'parameter_id.unique' => 'Ez a paraméter már korábban rögzítésre került!',
                'unit_id.required' => 'A mértékegység mező kitöltése kötelező!',
                'unit_id.exists' => 'Érvénytelen mértékegységkód.',
                'value.required' => 'Az érték mező kitöltése kötelező!',
                'value.max' => 'A érték nem lehet hosszabb, mint 25 karakter.',
            ]);

            $validated['loq'] = calculate_loq($validated['value']);
            $validated['maxrange'] = calculate_maxrange($validated['value']);
            $validated['valueassigned'] = calculate_valueassigned($validated['value']);

            $result->update($validated);

            $item = Sample::findOrFail($sample_id);
            $results = Result::where('sample_id', $sample_id)->get();
            $currentPage = $request->input('page', 1);

            return view('samples.show', compact('item', 'results', 'currentPage'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Result $result){

        if ($request->deleteall === 'true') {
            $sample_id = $request->sample_id;
            Result::where('sample_id', $sample_id)->delete();
//            return redirect()->back()
//            ->with('success', 'Eredmények sikeresen törölve!');
        } else {
            $sample_id = $result->sample_id;
            $result->delete();
 //           return redirect()->back()
 //               ->with('success', 'Eredmény sikeresen törölve!');
        }

        $item = Sample::findOrFail($sample_id);
        $results = Result::where('sample_id', $sample_id)->get();
        $currentPage = $request->input('page', 1);

        return view('samples.show', compact('item', 'results', 'currentPage'))->with('success', 'Eredmények sikeresen törölve!');;

    }

}
