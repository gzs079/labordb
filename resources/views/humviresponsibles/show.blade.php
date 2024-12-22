<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HUMVI felelősök') }}
        </h2>
        <h4>Részletek</h4>
    </x-slot>

    <div class="card border-primary col-md-4">
        <div class="card-body">

            <dl class="row">
                <dt class = "col-4"><strong>Felelős:</strong></dt> <dd class = "col-8"> {{ $item->responsible }}</dd>
                <dt class = "col-4"><strong>Név:</strong></dt> <dd class = "col-8"> {{ $item->name }}</dd>
                <dt class = "col-4"><strong>Cím:</strong></dt> <dd class = "col-8"> {{ $item->address }}</dd>
                <dt class = "col-4"><strong>Létrehozva:</strong></dt> <dd class = "col-8"> {{ $item->created_at }}</dd>
                <dt class = "col-4"><strong>Utolsó módosítás:</strong></dt> <dd class = "col-8"> {{ $item->updated_at }}</dd>
            </dl>

            <div class="form-group mt-3">
                <a href="{{ route('humviresponsibles.edit', [$item->id, 'page' => $currentPage]) }}" class="btn btn-warning">
                    Szerkesztés
                </a>
                <a href="{{ route('humviresponsibles.index', ['page' => $currentPage]) }}" class="btn btn-secondary">
                    Vissza
                </a>
            </div>

        </div>
    </div>


</x-app-layout>
