@if($banner_top = \App\Banner::find(1)->active == 1)
    <div class="banner">{!! $banner_top !!}</div>
@endif