@extends('layouts.app')
@section('container')
    <div class="col-sm-12 col-md-8 col-md-push-2 col-lg-8 col-lg-push-2">
        @yield('slider')
        @include('layouts.bannerTop')
        @include('layouts.message')
        @yield('content')
    </div>
    <div class="col-sm-12 col-md-2 col-md-pull-8 col-lg-2 col-lg-pull-8 left_panel">
        <div class="row">
            @if($banner_left = \App\Banner::find(2)->banner)
                <div class="banner">{!! $banner_left !!}</div>
            @endif
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2 right_panel">
        <div class="row">
            @include('layouts.map')
            @if($banner_right = \App\Banner::find(3)->banner)
                <div class="banner">{!! $banner_right !!}</div>
            @endif
        </div>
    </div>
    <div class="clear"></div>
@endsection