<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akkreditált mintavétel státusza') }}
        </h2>
        <h4>Részletek</h4>
    </x-slot>

    <div class="card border-primary col-md-4">
        <div class="card-body">

            <dl class="row">
                <dt class = "col-4"><strong>Mintavétel státusza:</strong></dt> <dd class = "col-8"> {{ $item->status }}</dd>
                <dt class = "col-4"><strong>Leírás:</strong></dt> <dd class = "col-8"> {{ $item->description }}</dd>
                <dt class = "col-4"><strong>Létrehozva:</strong></dt> <dd class = "col-8"> {{ $item->created_at }}</dd>
                <dt class = "col-4"><strong>Utolsó módosítás:</strong></dt> <dd class = "col-8"> {{ $item->updated_at }}</dd>
            </dl>

            <div class="form-group mt-3">
                <a href="{{ route('accreditedsamplingstatuses.edit', [$item->id, 'page' => $currentPage]) }}" class="btn btn-warning">
                    Szerkesztés
                </a>
                <a href="{{ route('accreditedsamplingstatuses.index', ['page' => $currentPage]) }}" class="btn btn-secondary">
                    Vissza
                </a>
            </div>

        </div>
    </div>


</x-app-layout>
