<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minták') }}
        </h2>
        <h4>Szerkesztés</h4>
    </x-slot>

    <form id="editForm" action="{{route('samples.update', $item)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-around">
            <!--LABORKÓD, HUMVIEXPORT-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">
                    <div class="form-group">
                        <label for="sample_lab_id" class="form-label">Laborkód</label>
                        <input type="text" class="form-control" id="sample_lab_id" name="sample_lab_id" value="{{ old('sample_lab_id', $item->sample_lab_id) }}">
                        @error('sample_lab_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="humvi_export" name="humvi_export" value="0">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="humvi_export" name="humvi_export" value="1" {{ old('humvi_export', $item->humvi_export) ? 'checked' : '' }}>
                            <label class="form-check-label" for="humvi_export">HUMVI feltöltés</label>
                        </div>
                        @error('humvi_export')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!--Mintavétel oka-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="samplingreason_id" class="form-label">Mintavétel oka</label>
                            <select class="form-control" id="samplingreason_id" name="samplingreason_id">
                                <option value="">Válasszon mintavételi okot</option>
                                @foreach ($samplingreasons as $samplingreason)
                                    <option value="{{ $samplingreason->id }}" {{ old('samplingreason_id', $item->samplingreason_id) == $samplingreason->id ? 'selected' : '' }}>
                                        {{ $samplingreason->reason }} - {{ $samplingreason->description }}
                                    </option>
                                @endforeach
                            </select>
                            @error('samplingreason_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sampling_reason_details" class="form-label">Mintavétel oka, részletes</label>
                            <input type="text" class="form-control" id="sampling_reason_details" name="sampling_reason_details" value="{{ old('sampling_reason_details', $item->sampling_reason_details) }}">
                            @error('sampling_reason_details')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-around">
            <!--Mintavétel dátuma, helye-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="date_sampling" class="form-label">Mintavétel dátuma</label>
                            <input type="date" class="form-control" id="date_sampling" name="date_sampling" value="{{ old('date_sampling', $item->formatted_date_sampling) }}">
                            @error('date_sampling')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-8">
                            <label for="samplingsite_id" class="form-label">Mintavétel helye</label>
                            <select class="form-control" id="samplingsite_id" name="samplingsite_id">
                                <option value="">Válasszon mintavételi hely kódot</option>
                                @foreach ($samplingsites as $samplingsite)
                                    <option value="{{ $samplingsite->id }}" {{ old('samplingsite_id', $item->samplingsite_id) == $samplingsite->id ? 'selected' : '' }}>
                                        {{ $samplingsite->site }} - {{ $samplingsite->name_full }}
                                    </option>
                                @endforeach
                            </select>
                            @error('samplingsite_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sampling_site_details" class="form-label">Egyéb megnevezés</label>
                        <input type="text" class="form-control" id="sampling_site_details" name="sampling_site_details" value="{{ old('sampling_site_details', $item->sampling_site_details) }}">
                        @error('sampling_site_details')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <!--Akkr mintavétel státusz, mintavevő-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">

                    <div class="form-group">
                        <label for="sampler_id" class="form-label">Mintavevő</label>
                        <select class="form-control" id="sampler_id" name="sampler_id">
                            <option value="">Válasszon mintavevőt</option>
                            @foreach ($samplers as $sampler)
                                <option value="{{ $sampler->id }}" {{ old('sampler_id', $item->sampler_id) == $sampler->id ? 'selected' : '' }}>
                                    {{ $sampler->name }} - {{ $sampler->accreditation_number }} (Érvényes: {{\Carbon\Carbon::parse($sampler->valid_starts)->format('Y-m-d')}} - {{\Carbon\Carbon::parse($sampler->valid_ends)->format('Y-m-d')}})
                                </option>
                            @endforeach
                        </select>
                        @error('sampler_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="accreditedsamplingstatus_id" class="form-label">Mintavétel státusza</label>
                        <select class="form-control" id="accreditedsamplingstatus_id" name="accreditedsamplingstatus_id">
                            <option value="">Válasszon státuszt</option>
                            @foreach ($accreditedsamplingstatuses as $accreditedsamplingstatus)
                                <option value="{{ $accreditedsamplingstatus->id }}" {{ old('accreditedsamplingstatus_id', $item->accreditedsamplingstatus_id) == $accreditedsamplingstatus->id ? 'selected' : '' }}>
                                    {{ $accreditedsamplingstatus->status }} - {{ $accreditedsamplingstatus->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('accreditedsamplingstatus_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="row justify-content-around">
            <!--Vizsgálólabor, mintaátvétel, vizsgálat kezdete, vizsgálat vége-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">

                    <div class="form-group">
                        <label for="laboratory_id" class="form-label">Vizsgálólabor</label>
                        <select class="form-control" id="laboratory_id" name="laboratory_id">
                            <option value="">Válasszon laboratóriumot</option>
                            @foreach ($laboratories as $laboratory)
                                <option value="{{ $laboratory->id }}" {{ old('laboratory_id', $item->laboratory_id) == $laboratory->id ? 'selected' : '' }}>
                                    {{ $laboratory->name }} - {{ $laboratory->accreditation_number }} (Érvényes: {{\Carbon\Carbon::parse($laboratory->valid_starts)->format('Y-m-d')}} - {{\Carbon\Carbon::parse($laboratory->valid_ends)->format('Y-m-d')}})
                                </option>
                            @endforeach
                        </select>
                        @error('laboratory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="date_samplereceipt" class="form-label">Mintaátvétel</label>
                            <input type="date" class="form-control" id="date_samplereceipt" name="date_samplereceipt" value="{{ old('date_samplereceipt', $item->formatted_date_samplereceipt) }}">
                            @error('date_samplereceipt')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date_analyses_start" class="form-label">Vizsgálat kezdete</label>
                            <input type="date" class="form-control" id="date_analyses_start" name="date_analyses_start" value="{{ old('date_analyses_start', $item->formatted_date_analyses_start) }}">
                            @error('date_analyses_start')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date_analyses_end" class="form-label">Vizsgálat vége</label>
                            <input type="date" class="form-control" id="date_analyses_end" name="date_analyses_end" value="{{ old('date_analyses_end', $item->formatted_date_analyses_end) }}">
                            @error('date_analyses_end')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <!--Modul, felelős, mintavétel típusa-->
            <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                <div class="card-body">
                    <div class="form-group col-auto">
                        <label for="humvimodule_id" class="form-label">Modul</label>
                        <select class="form-control" id="humvimodule_id" name="humvimodule_id">
                            <option value="">Válasszon modult</option>
                            @foreach ($humvimodules as $module)
                                <option value="{{ $module->id }}" {{ old('humvimodule_id', $item->humvimodule_id) == $module->id ? 'selected' : '' }}>
                                    {{ $module->modul }} - {{ $module->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('humvimodule_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-auto">
                        <label for="humviresponsible_id" class="form-label">Felelős</label>
                        <select class="form-control" id="humviresponsible_id" name="humviresponsible_id">
                            <option value="">Válasszon felelőst</option>
                            @foreach ($humviresponsibles as $responsible)
                                <option value="{{ $responsible->id }}" {{ old('humviresponsible_id', $item->humviresponsible_id) == $responsible->id ? 'selected' : '' }}>
                                    {{ $responsible->responsible }} - {{ $responsible->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('humviresponsible_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-auto">
                        <label for="samplingtype_id" class="form-label">Mintavétel típusa</label>
                        <select class="form-control" id="samplingtype_id" name="samplingtype_id">
                            <option value="">Válasszon típust</option>
                            @foreach ($samplingtypes as $samplingtype)
                                <option value="{{ $samplingtype->id }}" {{ old('samplingtype_id', $item->samplingtype_id) == $samplingtype->id ? 'selected' : '' }}>
                                    {{ $samplingtype->type }} - {{ $samplingtype->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('samplingtype_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejtett mező az aktuális oldalszám számára -->
        <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">

        @include('partials._edit-actions', [
            'id' => $item->id,
            'controllerName' => 'samples',
            'page' => request()->input('page')
            ])

    </form>

</x-app-layout>
