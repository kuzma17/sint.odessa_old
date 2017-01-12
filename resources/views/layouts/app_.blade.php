<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" >

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link href="/css/style.css" rel="stylesheet"/>
    <link href="8768/css/app.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap-social.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="top-wrapper">
    <div class="container">
        <div class="col-sm-12 col-md-8 col-lg-2">Добро пожаловать.</div>
        <div class="rcol-sm-12 col-md-8 col-lg-10">
            <ul class="top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-heart"></i> favorite</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-envelope"></i> mail</a></li>
                <li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> Login</a>

                    <ul id="login-dp" class="dropdown-menu dropdown-menu-right">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    Login via
                                    <div class="social-buttons">
                                        <a href="#" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                        <a href="#" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                        <a href="#" class="btn btn-od"><i class="fa fa-odnoklassniki"></i> Odniklassniki</a>
                                        <a class="btn btn-block btn-social btn-odnoklassniki">
                                            <i class="fa fa-odnoklassniki"></i> ... Odnoklassniki
                                        </a>
                                        <a href="#" class="btn btn-vk"><i class="fa fa-vkontakte"></i> Vkontakte</a>
                                        <a class="btn btn-block btn-social btn-vk">
                                            <span class="fa fa-vk"></span> ... VK
                                        </a>
                                        <a href="#" class="btn btn-mr"><i class="fa fa-at"></i> Mail.ru</a>
                                        <a class="btn btn-block btn-social btn-twitter">
                                            <span class="fa fa-at"></span> ... Mail.ru
                                        </a>
                                        <a class="btn btn-block btn-social btn-google">
                                            <span class="fa fa-google"></span> ... Google
                                        </a>
                                    </div>
                                    or
                                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                            <div class="help-block text-right"><a href="">Forget the password ?</a></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> keep me logged-in
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <div class="bottom text-center">
                                    New here ? <a href="#"><b>Join Us</b></a>
                                </div>
                            </div>
                        </li>
                    </ul>


                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container logo-bar">
    <div class="rcol-sm-12 col-md-8 col-lg-4">
        <img src="/images/logo02.png" style="margin-top: 10px">

    </div>
    <div class="col-sm-12 col-md-8 col-lg-4" style="padding-top: 30px; padding-left: 50px">
        <form role="form" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" style="width: 300px; height: 30px">
                <span class="input-group-btn">
          <button class="btn btn-default" type="button" style="padding: 4px">поиск</button>
        </span>
            </div>
        </form>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-4" style="padding-top: 10px">
        <button type="button" class="btn btn-success btn-top" style="margin-right: -15px"><i class="glyphicon glyphicon-plus"></i> Сделать заказ </button>
        <button type="button" class="btn btn-info btn-top" style="margin-right: 10px"><i class="glyphicon glyphicon-shopping-cart"></i> Интернет магазин</button>
    </div>
    <div style="clear: both"></div>

    <div class="row" style="margin-top: 10px">
        <nav class="navbar navbar-default navbar-inverse">
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
                    <li><a href="#">Главная</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Услуги</a></li>
                    <li class="active"><a href="#">Товары</a></li>
                    <li><a href="#">Цены</a></li>
                    <li><a href="#">Диллерам</a></li>
                    <li><a href="#">Координаты</a></li>
                    <li><a href="#">Фотогалерея</a></li>
                </ul>
            </div>
        </nav>
    </div>

</div>

<div style="clear: both"></div>

<div class="container" style="padding: 0; margin-top: -10px">
    <div class="col-sm-12 col-md-2 col-lg-2" style="padding: 1px; border: 1px #cccccc solid">
        <img src="/images/banners.png" style="width:190px">
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8" style="padding: 7px">



        @yield('content')


    </div>
    <div class="col-sm-12 col-md-2 col-lg-2" style="padding: 0">
        <img src="/images/map.png" style="width:190px">
    </div>
    <div style="clear: both"></div>
    <div class="col-sm-4 col-sm-push-8">.col-sm-4 .col-sm-push-8</div>
    <div class="col-sm-8 col-sm-pull-4">.col-sm-8 .col-sm-pull-4</div>

    <div class="col-sm-5 col-md-6">.col-sm-5 .col-md-6</div>
    <div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-1"> .col-sm-5 .col-sm-offset-2 .col-md-6 .col-md-offset-0</div>
</div>

<div class="bottom-wrapper">
    <div class="container" style="background: #33363b; padding: 20px">
        <div class="col-sm-12 col-md-2 col-lg-4" style="border-right: 1px #484a4f solid">
            <h4>Контакты</h4>

            <ul style="list-style: none;">
                <li><i class="glyphicon glyphicon-map-marker"></i> Главный офис Адмиральский пр. 33А</li>
                <li><i class="glyphicon glyphicon-earphone"></i> 735-55-78, 333-56-76, 776-78-65</li>
                <li><i class="glyphicon glyphicon-phone"></i> +380 674567790, +380 674567790</li>
                <li><i class="glyphicon glyphicon-envelope"></i> info@sint.odessa.ua</li>
                <li><i class="glyphicon glyphicon-globe"></i> http//:sint.odessa.ua</li>
                <li><i class="glyphicon glyphicon-shopping-cart"></i> http://sint-market.prom.ua</li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-2 col-lg-4" style="border-right: 1px #484a4f solid; min-height: 160px">
            <h4>Филиалы</h4>

            <ul style="list-style: none;">
                <li><i class="glyphicon glyphicon-map-marker"></i> Адмиральский пр. 33А
                    <i class="glyphicon glyphicon-earphone"></i> 735-55-78</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Соборная пл. 2
                    <i class="glyphicon glyphicon-earphone"></i> 735-55-78</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Днепропетровская дор. 78
                    <i class="glyphicon glyphicon-earphone"></i> 735-55-78</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Королева 38
                    <i class="glyphicon glyphicon-earphone"></i> 735-55-78</li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-2 col-lg-4">
            <h4>Навигация</h4>

            <ul style="float: left">
                <li><a href="">Главная</a></li>
                <li><a href="">О нас</a></li>
                <li><a href="">Услуги</a></li>
                <li><a href="">Товары</a></li>
            </ul>
            <ul style="float: left">
                <li><a href="">Цены</a></li>
                <li><a href="">Диллерам</a></li>
                <li><a href="">Координаты</a></li>
                <li><a href="">Фотогалерея</a></li>
            </ul>
        </div>

    </div>
</div>
<div class="copyright-wrapper">
    <div class="container">
        <div style="float: right">Copyright 2016 @ design by kuzma</div>
    </div>
</div>




    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
