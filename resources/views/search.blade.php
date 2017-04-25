@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>Результаты поиска</h3>
        @if($results)
            @foreach($results as $result)
                <h5>{{ $result->title }}</h5>
            <a href="" >подробнее...</a><br>
                    {!! \Illuminate\Support\Str::words($result->content, 50) !!}
            @endforeach
        @endif
    </div>
@endsection
