@extends('app')
@section('content')

@component('@.bootstrap.header', [
    'title' => $codigor->nombre,
    'pretitle' => 'Código de reempacado',
    'goback' => route('codigosr.index'),
])
@endcomponent

<p class="border rounded p-3">
    <span class="me-2">{!! $svg->info_circle_fill !!}</span>
    <span class="align-middle">{{ $codigor->descripcion }}</span>
</p>

<div class="row">

    <!-- Column reempacados -->
    <div class="col-sm">
        @component('@.bootstrap.card-headers', [
            'header_left' => 'Reempacados',
        ])
            @slot('header_right')
            <span class="align-middle me-1">Total</span>
            <a href="#!" class="">
                <span class="badge bg-primary text-white">{{ $entradas->count() }}</span>
            </a>
            @endslot

            @slot('body')
            @component('@.bootstrap.table', [
                'thead' => ['Reempacador','Entradas'],
                'borderless' => true,
            ])
                @slot('tbody')
                @foreach($reempacadores as $id => $reempacador)
                <tr>
                    <td>{{ $reempacador->nombre }}</td>
                    <td>{{ $reempacador->counter }}</td>
                </tr>
                @endforeach
                @endslot
            @endcomponent
            @endslot
        @endcomponent
    </div>

    <!-- Column entradas -->
    <div class="col-sm col-sm-8">
        @component('@.bootstrap.card', [
            'header' => 'Entradas recientes'
        ])
            @slot('body')
            @component('@.partials.table-entradas', [
                'entradas' => $entradas
            ])
            @endcomponent
            @endslot
        @endcomponent
    </div>
</div>
<br>

@endsection
