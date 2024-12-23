<div class="form-group mt-3">

    <input type="submit" value="Mentés" class="btn btn-primary" data-bs-toggle="tooltip" title="Módosítások mentése"/>

    <a href="{{ route($controllerName . '.index', ['page' => request()->input('page')]) }}" class="btn btn-secondary" data-bs-toggle="tooltip" title="Vissza az előző oldalra">
        Mégsem
    </a>

</div>


