@if($banner_top = \App\Banner::find(1)->banner)
    <div class="banner">{!! $banner_top !!}</div>
@endif