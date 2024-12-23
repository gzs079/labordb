<div class="form-group mt-3">
    <a href="{{ route($controllerName . '.edit', [$item->id, 'page' => $currentPage]) }}" class="btn btn-warning" data-bs-toggle="tooltip" title="Rekord szerkesztése">
        Szerkesztés
    </a>
    <a href="{{ route($controllerName . '.index', ['page' => $currentPage]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Vissza az előző oldalra">
        Vissza
    </a>
</div>
