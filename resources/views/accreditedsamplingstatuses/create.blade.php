<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akkreditált mintavétel státusza') }}
        </h2>
        <h4>Új rekord létrehozása</h4>
    </x-slot>

            <form id="createForm" action="{{route('accreditedsamplingstatuses.store')}}" method="POST">
                @csrf

                <div class="card border-primary col-md-4">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="status" class="form-label">Mintavétel státusza</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}">
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Leírás</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Létrehozás" class="btn btn-primary" />
                            <a href="{{ route('accreditedsamplingstatuses.index', ['page' => request()->input('page')]) }}" class="btn btn-secondary">
                                Mégsem
                            </a>
                        </div>

                    </div>
                </div>

            </form>


</x-app-layout>
