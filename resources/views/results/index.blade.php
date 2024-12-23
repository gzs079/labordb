

        <table class="table table-striped stickyheader mt-3">
            <thead>
            <tr>
                <th>Paraméter</th>
                <th>Mértékegység</th>
                <th>Érték</th>
                <th>Alsó méréshatár</th>
                <th>Legnagyobb mérhető érték</th>
                <th>Hozzárendelt érték</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($results as $result)
                <tr>
                    <td>{{ $result->parameter->description_labor }}</td>
                    <td>{{ $result->unit->description_labor }}</td>
                    <td>{{ $result->value }}</td>
                    <td>{{ $result->loq }}</td>
                    <td>{{ $result->maxrange }}</td>
                    <td>{{ $result->valueassigned }}</td>
                    <td class="actioncol">
                        @include('partials._listing-actions', [
                            'id' => $result->id,
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
            {{ $items->links('pagination::bootstrap-5') }}
    @endsection

