@extends('app')
@section('content')

<p class="text-end">
   <a href="{{ route('entradas.show', $entrada) }}" class="btn btn-sm btn-secondary">Regresar</a>
</p>

@component('components.card', [
   'header_title' => 'Destinatarios encontrados',
   'header_title_badge' => $destinatarios->count(),
])
   @slot('header_options')
   <button data-bs-toggle="modal" data-bs-target="#modal-search-destinatarios" type="button" class="btn btn-primary btn-sm">
      {!! $icons->search !!}
   </button>
   <a href="{{ route('destinatarios.create', ['entrada' => $entrada->id]) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nuevo destinatario">
      <span>{!! $icons->plus !!}</span>
   </a>
   @endslot

   @slot('body')
   @if( $destinatarios->count() )

   @component('components.table', [
      'thead' => ['Nombre', 'Dirección','Postal', 'Localidad', 'Teléfono',''],
   ])
      @slot('tbody')
         @foreach($destinatarios as $destinatario)
         <tr>
            <td class="">{{ $destinatario->nombre }}</td>
            <td class="">{{ $destinatario->direccion }}</td>
            <td class="">{{ $destinatario->codigo_postal }}</td>
            <td class="">{{ $destinatario->localidad }}</td>
            <td class="">{{ $destinatario->telefono }}</td>
            <td class="text-end">
               <button name="destinatario" value="{{ $destinatario->id }}" class="btn btn-success btn-sm" form="form-update-destinatario" type="submit">Agregar</button>
            </td>
         </tr>
         @endforeach
      @endslot
   @endcomponent

   <form action="{{ route('entradas.update', $entrada) }}" method="post" id="form-update-destinatario">
      @method('put')
      @csrf
      <input type="hidden" name="actualizar" value="destinatario">
   </form>
   
   @else
   <p class="text-center lead">
      <span class="text-muted">Sin resultados de</span>
      <b class="">{{ $searched }}</b>
   </p>

   @endif
   @endslot
@endcomponent

@include('entradas.trayectoria.modal-search-destinatarios')
@endsection
