@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>Акции</h3>
        @foreach($stocks as $stock)
            <a href="{{ url('/stock/'.$stock->id) }}" ><strong>{{ $stock->title }}</strong></a><br>
            {!! \Illuminate\Support\Str::words($stock->content, 50) !!}
            <a href="{{ url('/stock/'.$stock->id) }}">подробнее</a>
            <div class="clear"></div>
        @endforeach
    </div>
@endsection
