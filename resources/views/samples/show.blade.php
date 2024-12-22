<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minták') }}
        </h2>
        <h4>Részletek</h4>
    </x-slot>

    <div class="row">
        <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
            <div class="card-body">
                <dl class="row">
                    <dt class = "col-4"><strong>Laborkód:</strong></dt> <dd class = "col-8"> {{ $item->sample_lab_id }}</dd>
                    <dt class = "col-4"><strong>HUMVI feltöltés:</strong></dt> <dd class = "col-8"> {{ $item->humvi_export }}</dd>
                    <dt class = "col-4"><strong>Mintavétel oka:</strong></dt> <dd class = "col-8"> {{ $item->samplingreason->reason }}</dd>
                    <dt class = "col-4"><strong>Mintavétel oka, egyéb:</strong></dt> <dd class = "col-8"> {{ $item->sampling_reason_details ? $item->sampling_reason_details : "-"}}</dd>
                    <dt class = "col-4"><strong>Mintavétel dátuma:</strong></dt> <dd class = "col-8"> {{ $item->formatted_date_sampling }}</dd>
                    <dt class = "col-4"><strong>Mintavétel helye:</strong></dt> <dd class = "col-8"> {{ $item->samplingsite->name_full }}</dd>
                    <dt class = "col-4"><strong>Ivóvízbázis:</strong></dt> <dd class = "col-8"> {{ $item->samplingsite->aquifer }}</dd>
                    <dt class = "col-4"><strong>Település:</strong></dt> <dd class = "col-8"> {{ $item->samplingsite->settlement }}</dd>
                    <dt class = "col-4"><strong>Mintavétel helye, egyéb:</strong></dt> <dd class = "col-8"> {{ $item->sampling_site_details ? $item->sampling_site_details : "-" }}</dd>
                    <dt class = "col-4"><strong>Mintavevő:</strong></dt> <dd class = "col-8"> {{ $item->sampler_id ? $item->sampler->name : '-' }}</dd>
                    <dt class = "col-4"><strong>Mintavétel státusza:</strong></dt> <dd class = "col-8"> {{ $item->accreditedsamplingstatus_id ? $item->accreditedsamplingstatus->status : "-" }}</dd>
                    <dt class = "col-4"><strong>Vizsgálólabor:</strong></dt> <dd class = "col-8"> {{ $item->laboratory->name }}</dd>
                    <dt class = "col-4"><strong>Mintaátvétel dátuma:</strong></dt> <dd class = "col-8"> {{ $item->formatted_date_samplereceipt ? $item->formatted_date_samplereceipt : "-" }}</dd>
                    <dt class = "col-4"><strong>Vizsgálat kezdete:</strong></dt> <dd class = "col-8"> {{ $item->formatted_date_analyses_start ? $item->formatted_date_analyses_start : "-" }}</dd>
                    <dt class = "col-4"><strong>Vizsgálat vége:</strong></dt> <dd class = "col-8"> {{ $item->formatted_date_analyses_end ? $item->formatted_date_analyses_end : "-" }}</dd>
                    <dt class = "col-4"><strong>Modul:</strong></dt> <dd class = "col-8"> {{ $item->humvimodule->description }}</dd>
                    <dt class = "col-4"><strong>Felelős:</strong></dt> <dd class = "col-8"> {{ $item->humviresponsible->name }}</dd>
                    <dt class = "col-4"><strong>Mintavétel típusa:</strong></dt> <dd class = "col-8"> {{ $item->samplingtype->type }}</dd>
                </dl>
                <div class="form-group mt-3">
                    <a href="{{ route('samples.edit', [$item->id, 'page' => $currentPage]) }}" class="btn btn-warning">
                        Szerkesztés
                    </a>
                    <a href="{{ route('samples.index', ['page' => $currentPage]) }}" class="btn btn-secondary">
                        Vissza
                    </a>
                </div>
            </div>
        </div>

        <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
            <div class="card-body">
            </div>
        </div>
    </div>

</x-app-layout>
