<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akkreditált mintavétel státusza') }}
        </h2>
        <h4>Részletek</h4>
    </x-slot>

    <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
        <div class="card-body">

            <dl class="row">
                <dt class = "col-4"><strong>Mintavétel státusza:</strong></dt> <dd class = "col-8"> {{ $item->status }}</dd>
                <dt class = "col-4"><strong>Leírás:</strong></dt> <dd class = "col-8"> {{ $item->description }}</dd>
                <dt class = "col-4"><strong>Létrehozva:</strong></dt> <dd class = "col-8"> {{ $item->created_at }}</dd>
                <dt class = "col-4"><strong>Utolsó módosítás:</strong></dt> <dd class = "col-8"> {{ $item->updated_at }}</dd>
            </dl>

            @include('partials._show-actions', [
                'id' => $item->id,
                'controllerName' => 'accreditedsamplingstatuses',
                'page' => request()->input('page')
                ])

        </div>
    </div>


</x-app-layout>
