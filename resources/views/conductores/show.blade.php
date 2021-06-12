@extends('app')
@section('content')

@component('@.bootstrap.header', [
    'title' => $conductor->nombre,
    'pretitle' => 'Conductor',
    'goback' => route('conductores.index'),
])
@endcomponent

<div class="row">
    <!-- Column importados -->
    <div class="col-sm">
        @component('@.bootstrap.card')
            @slot('header', 'Importados')
        @endcomponent
    </div>

    <!-- Column entradas -->
    <div class="col-sm col-sm-8">
        @component('@.bootstrap.card')
            @slot('header', 'Entradas recientes')
            @slot('body')
                @component('@.partials.table-entradas', [
                    'entradas' => $entradas
                ])
                @endcomponent
            @endslot
        @endcomponent
    </div>
</div>

@endsection
