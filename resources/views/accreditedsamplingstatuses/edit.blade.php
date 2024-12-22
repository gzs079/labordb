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

        <div class="card border-primary col-md-4">
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

                <div class="form-group mt-3">
                    <input type="submit" value="Mentés" class="btn btn-primary" />
                    <a href="{{ route('accreditedsamplingstatuses.index', ['page' => request()->input('page')]) }}" class="btn btn-secondary">
                        Mégsem
                    </a>
                </div>

            </div>
        </div>

    </form>

</x-app-layout>
