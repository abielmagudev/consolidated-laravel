@extends('app')
@section('content')
<div class="row">
    <div class="col-sm">
        @include('transportadoras.show.informacion')
    </div>
    <div class="col-sm col-sm-8">
    </div>
</div>
@include('transportadoras.show.eliminar')
@endsection