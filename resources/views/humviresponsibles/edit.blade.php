<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HUMVI felelősök') }}
        </h2>
        <h4>Szerkesztés</h4>
    </x-slot>

    <form id="editForm" action="{{route('humviresponsibles.update', $item)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
            <div class="card-body">

                <div class="form-group">
                    <label for="responsible" class="form-label">Felelős</label>
                    <input type="text" class="form-control" id="responsible" name="responsible" value="{{ old('responsible', $item->responsible) }}">
                    @error('responsible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Név</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Cím</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $item->address) }}">
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rejtett mező az aktuális oldalszám számára -->
                <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">

                @include('partials._edit-actions', [
                    'id' => $item->id,
                    'controllerName' => 'humviresponsibles',
                    'page' => request()->input('page')
                    ])

            </div>
        </div>

    </form>

</x-app-layout>
