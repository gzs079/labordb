<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minták') }}
        </h2>
    </x-slot>

        <table class="table table-striped stickyheader mt-3">
            <thead>
            <tr>
                <th>HUMVI export</th>
                <th>Laborkód</th>
                <th>Modul</th>
                <th>Mintavétel dátuma</th>
                <th>Mintavétel oka</th>
                <th>Mintavétel helye</th>
                <th>Ivóvízbázis</th>
                <th>Település</th>
                <th>Vizsgálólabor</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                <tr>
                    <td><input type="checkbox" disabled {{ $item->humvi_export ? 'checked' : '' }}></td>
                    <td>{{ $item->sample_lab_id }}</td>
                    <td>{{ $item->humvimodule->modul }}</td>
                    <td>{{ $item->formatted_date_sampling }}</td>
                    <td>{{ $item->samplingreason->reason }}</td>
                    <td>{{ $item->samplingsite->name_full }}</td>
                    <td>{{ $item->samplingsite->aquifer }}</td>
                    <td>{{ $item->samplingsite->settlement }}</td>
                    <td>{{ $item->laboratory->name }}</td>
                    <td class="actioncol">
                        @include('partials._listing-actions', [
                            'id' => $item->id,
                            'controllerName' => 'samples',
                            'page' => request()->input('page')
                            ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Az adattábla nem tartalmaz rögzített adatot!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    <!-- Paginátor -->
    @section('footer-paginator')
        <div class="container mt-6">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>
    @endsection

</x-app-layout>
