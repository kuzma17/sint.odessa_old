<?php
if(Request::path() == 'login_admin'){
    $app = 'admin.app';
}else{
    $app = 'layouts.container3';
}
?>
@extends($app)
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Авторизация.@if(Request::path() == 'login_admin') Вход для администратора.@endif</div>
                <div class="panel-body">
                    @if(Request::path() != 'login_admin')
                        <div class="form-group" style="border-bottom: 1px solid #cccccc">
                            <label for="email" class="col-md-4 control-label">Авторизация через соцсети</label>

                            <div class="col-md-6" style="padding: 6px">

                                <div class="social-buttons2">
                                    <a href="{{ url('/social/facebook') }}" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="{{ url('/social/twitter') }}" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>
                                    <a href="{{ url('/social/odniklassniki') }}" class="btn btn-od"><i class="fa fa-odnoklassniki"></i> Odniklassniki</a>
                                    <a href="{{ url('/social/vkontakte') }}" class="btn btn-vk"><i class="fa fa-vk"></i> Vkontakte</a>
                                    <a href="{{ url('/social/mailru') }}" class="btn btn-mr"><i class="fa fa-at"></i> Mail.ru</a>
                                    <a href="{{ url('/social/google') }}" class="btn btn-go"><i class="fa fa-google"></i> Google</a>
                                    <a href="{{ url('/social/github') }}" class="btn btn-git"><i class="fa fa-github" aria-hidden="true"></i> Github</a>
                                </div>

                            </div>
                            <div class="clear"></div>
                        </div>

                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Запомнить пароль
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Вход
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Забыли пароль?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                @if(Request::path() != 'login_admin')
                    <div class="panel-heading" style="border-top: 1px solid #cccccc">
                        Впервые здесь ? <a style="float: right" href="{{ url('/register') }}"><b>Регистрация</b></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
