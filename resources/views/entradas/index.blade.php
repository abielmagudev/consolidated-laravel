@extends('app')
@section('content')

@component('@.partials.page-header', [
    'title' => 'Entradas',
    'counter' => $entradas->count(),
])
    @slot('options')
    <a href="{{ route('entradas.create') }}" class="btn btn-sm btn-primary">
        <span class="d-block d-md-none fw-bold">+</span>
        <span class="d-none d-md-block">Nueva entrada</span>
    </a>
    @endslot
@endcomponent

@component('@.bootstrap.card')
    @slot('header')
    <div class="text-end">
        @include('@.partials.entradas-filter.trigger')
        @include('@.partials.checkboxes-checker.trigger')
        @include('@.partials.sheets-printing-dropdown')
    </div>
    @endslot

    @slot('body')
    @component('@.partials.entradas-table', [
        'entradas' => $has_pagination ? $entradas->getCollection() : $entradas,
        'checkboxes_form' => 'formEntradasPrinting',
    ]) 
    @endcomponent
    @endslot

@endcomponent
<br>

@if( $has_pagination )
    @component('@.bootstrap.pagination-simple', [
        'prev' => $entradas->previousPageUrl() ?? null,
        'next' => $entradas->nextPageUrl() ?? null,
    ])
    @endcomponent
@endif

@include('@.partials.entradas-filter.modal', ['results_route' => route('entradas.index')])
@include('@.partials.checkboxes-checker.scripts', ['checkbox_prefix' => 'checkboxEntrada'])

{{-- $has_pagination ? $entradas->getCollection() : $entradas --}}
{{-- $has_pagination ? $entradas->total() : $entradas->count() --}}

@endsection
