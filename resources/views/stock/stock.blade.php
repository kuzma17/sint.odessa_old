@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>{{ $stock->title }}</h3>
			@if($stock->banner != '')
            <img src="{{ $stock->banner }}" style="float:left; margin: 5px">
			@endif
            {!! $stock->content !!}
    </div>
@endsection