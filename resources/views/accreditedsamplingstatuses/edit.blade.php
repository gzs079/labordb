<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akkreditált mintavétel státusza') }}
        </h2>
        <h4>Szerkesztés</h4>
    </x-slot>

    <form id="editForm" action="{{route('accreditedsamplingstatuses.update', $item)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
            <div class="card-body">

                <div class="form-group">
                    <label for="status" class="form-label">Mintavétel státusza</label>
                    <input type="text" class="form-control" id="status" name="status" value="{{ old('status', $item->status) }}">
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Leírás</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $item->description) }}">
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rejtett mező az aktuális oldalszám számára -->
                <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">

                @include('partials._edit-actions', [
                    'id' => $item->id,
                    'controllerName' => 'accreditedsamplingstatuses',
                    'page' => request()->input('page')
                    ])

            </div>
        </div>

    </form>

</x-app-layout>
