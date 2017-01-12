@if(Request::path() == '/')
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="border 1px solid #cccccc; margin-bottom: 10px">
    <ol class="carousel-indicators">
        @for($i = 0; $i < count($slider); $i++)
            @if($i == 0)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="active"></li>
            @else
                <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
            @endif
        @endfor
    </ol>
    <div class="carousel-inner">
        <?php $s = 0; ?>
        @foreach($slider as $image)
            <div class="item @if($s == 0) active @endif">
                <img src="{{ $image->image }}" alt="{{ $image->slogan }}">
            </div>
            <?php $s++; ?>
        @endforeach
    </div>
    <div class="carousel-slogan"></div>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
@endif