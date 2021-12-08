<?php 

$entradas_filters = [
    'numero',
    'ambitos',
    'clientes',
    'etapas',
    'tiempos',
    'muestreos',
];

$settings = (object) [
    'filters' => isset($except) && is_array($except) ? array_diff($entradas_filters, $settings->except) : $entradas_filters,
    'route' => $route,
    'id' => 'modalFiltrarEntradas',
];

?>

@component('@.bootstrap.modal', [
    'id' => $settings->id,
    'title' => 'Filtrar entradas',
    'header_close' => true,
])
    <!-- Inicio del formulario para filtrar entradas -->
    <form action="{{ $settings->route }}" method="get" id="formFiltersEntradas">
        @foreach($settings->filters as $filter)
            @include("entradas.components.modal-filter.filters.{$filter}")
        @endforeach
        <hr>
        
        <input type="hidden" name="token" value="<?= csrf_token() ?>">
        <div class="text-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary" form="formFiltersEntradas">Filtrar entradas</button>
        </div>
    </form>
    <!-- Fin del formulario para filtrar entradas -->
@endcomponent
