@extends('printing')
@section('content')

    @foreach($collection as $item)
        @php extract($item->content()) @endphp
        @include($template)
    @endforeach
    
@endsection
