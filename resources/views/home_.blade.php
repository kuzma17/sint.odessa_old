@extends('layouts.app')

@section('content')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Указатели -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>
        <!-- Контент слайда (slider wrap)-->
        <div class="carousel-inner">
            <div class="item active">
                <img src="images/slider01.png" style="width: 765px; border: 1px #cccccc solid" alt="">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="images/slider02.png" style="width: 765px; border: 1px #cccccc solid" alt="">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="images/slider03.png" style="width: 765px; border: 1px #cccccc solid" alt="">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="images/slider04.png" style="width: 765px; border: 1px #cccccc solid" alt="">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        </div>
        <!-- Элементы управления -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
