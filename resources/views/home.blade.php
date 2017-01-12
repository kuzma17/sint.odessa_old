@extends('layouts.app')

@section('content')
	<div class="content-page">
    <h3>{{ $page->title }}</h3>
    {!! $page->content !!}
    @if(count($news) > 0)
        <h4 style="color: royalblue" ><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новости</h4>
        <div style="background-color: #f2f2f2; padding: 10px">
        @foreach($news as $new)
            <div>
                <a href="/news/{{ $new->id }}">{{ $new->title }}</a></br>
            <span style="float: right; font-weight: normal; color: orangered; font-size: 12px; margin-top: -20px">[ {{ date('d.m.Y', strtotime($new->published_at))}} ]</span>
            {!! \Illuminate\Support\Str::limit($new->content, 500) !!}
                <a href="/news/{{ $new->id }}">подробнее</a>
				<div class="clear"></div><br>
            </div>
        @endforeach
            </div>
    @endif
	</div>
@endsection
