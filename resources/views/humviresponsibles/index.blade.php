<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('HUMVI felelősök') }}
        </h2>
    </x-slot>

        <table class="table table-striped stickyheader mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Felelős</th>
                <th>Név</th>
                <th>Cím</th>
                <th>Létrehozva</th>
                <th>Utolsó módosítás</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->responsible }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td class="actioncol">
                        @include('partials._listing-actions', [
                            'id' => $item->id,
                            'controllerName' => 'humviresponsibles',
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
            {{ $items->links('pagination::bootstrap-5') }}
    @endsection

</x-app-layout>
