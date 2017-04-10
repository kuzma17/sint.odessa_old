@extends('layouts.container3')

@section('content')
<div class="content-page">
<h3>Новости</h3>
@foreach($news as $new)
    <h5>{{ $new->title }}</h5>
    <span class="date_news">{{ date('d m Y', strtotime($new->published_at))}}</span>
    {!! \Illuminate\Support\Str::words($new->content, 50) !!}
    <a href="/news/{{ $new->id }}">подробнее</a>
<div class="clear"></div>
@endforeach
</div>
    {!! $news->render() !!}
@endsection
