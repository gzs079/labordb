<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HUMVI felelősök') }}
        </h2>
        <h4>Új rekord létrehozása</h4>
    </x-slot>

            <form id="createForm" action="{{route('humviresponsibles.store')}}" method="POST">
                @csrf

                <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="responsible" class="form-label">Felelős</label>
                            <input type="text" class="form-control" id="responsible" name="responsible" value="{{ old('responsible') }}">
                            @error('responsible')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Név</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Cím</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Létrehozás" class="btn btn-primary" />
                            <a href="{{ route('humviresponsibles.index', ['page' => request()->input('page')]) }}" class="btn btn-secondary">
                                Mégsem
                            </a>
                        </div>

                    </div>
                </div>

            </form>


</x-app-layout>
