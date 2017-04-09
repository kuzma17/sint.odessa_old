<?php
$menu = \App\Menu::where('active', 1)->orderBy('weight', 'asc')->get();
?>
<nav class="navbar navbar-default navbar-inverse" style="margin-top: 10px">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
            @foreach($menu as $link)
            <li class="menu_site @if(Request::path() == $link->url) active_menu @endif"><a href="{{ url($link->url) }}">{{ $link->title }}</a></li>
            @endforeach
        </ul>
    </div>
</nav>
