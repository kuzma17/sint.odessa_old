@extends('layouts.app')

@section('content')
    <div class="content-page">
        <h3>{{ $page->title }}</h3>
        {!! $page->content !!}
    </div>
@endsection