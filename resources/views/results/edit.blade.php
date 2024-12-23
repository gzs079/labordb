<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eredmények') }}
        </h2>
        <h4>Szerkesztés</h4>
    </x-slot>

              <form id="editForm" action="{{route('results.update', $item)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="card flex shadow col-md-5 col-sm-10 col-xs-10 mx-4 my-2">
                    <div class="card-body">

                        <!--hidden mezők sample_id és sample page index továbbadásához-->
                        <input type="hidden" class="form-control" id="sample_id" name="sample_id" value="{{ $item->sample_id }}">
                        <input type="hidden" class="form-control" id="page" name="page" value="{{ request()->input('page') }}">

                        <!--paraméter-->
                        <div class="form-group">
                            <label for="parameter_id" class="form-label">Paraméter</label>
                            <select class="form-control" id="parameter_id" name="parameter_id">
                                <option value="">Válasszon paramétert</option>
                                @foreach ($parameters as $parameter)
                                    <option value="{{ $parameter->id }}" {{ old('parameter_id', $item->parameter_id) == $parameter->id ? 'selected' : '' }}>
                                        {{ $parameter->par_code }} - {{ $parameter->description_labor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parameter_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--mértékegység-->
                        <div class="form-group">
                            <label for="unit_id" class="form-label">Mértékegység</label>
                            <select class="form-control" id="unit_id" name="unit_id">
                                <option value="">Válasszon mértékegységet</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id', $item->unit_id) == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->unit_code }} - {{ $unit->description_labor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!--érték-->
                        <div class="form-group">
                            <label for="value" class="form-label">Érték</label>
                            <input type="text" class="form-control" id="value" name="value" value="{{ old('value', $item->value) }}">
                            @error('value')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Mentés" class="btn btn-primary" />
                            <a href="{{ route('samples.show', [$sample, 'page' => request()->input('page')]) }}" class="btn btn-secondary">
                                Mégsem
                            </a>
                        </div>

                    </div>
                </div>

            </form>

</x-app-layout>

