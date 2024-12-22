<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akkreditált mintavétel státusza') }}
        </h2>
    </x-slot>

        <table class="table table-striped stickyheader mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Mintavétel státusza</th>
                <th>Leírás</th>
                <th>Létrehozva</th>
                <th>Utolsó módosítás</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td class="actioncol">
                        @include('partials._listing-actions', [
                            'id' => $item->id,
                            'controllerName' => 'accreditedsamplingstatuses',
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
