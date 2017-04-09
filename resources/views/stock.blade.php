@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>Акции</h3>
        @foreach($stocks as $stock)
            <strong>{{ $stock->title }}</strong><br>
			@if($stock->banner != '')
            <img src="{{ $stock->banner }}" style="float:left; margin: 5px">
			@endif
            {!! $stock->content !!}
            <div class="clear"></div>
        @endforeach
    </div>
@endsection
