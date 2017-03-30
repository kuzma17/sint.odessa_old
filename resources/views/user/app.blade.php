@extends('layouts.app')
@section('content')
    <?php if(isset(Auth::user()->profile->avatar)){$avatar = '/'.Auth::user()->profile->avatar;} ?>
    <h3>Личный кабинет пользователя</h3>
    @if($message = Session::pull('ok_message'))
        <div class="alert alert-success alert-message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-check fa-lg"></i> {{ $message }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-warning alert-message">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
            </div>
    @endif

    <div class="rcol-sm-6 col-md-4 col-lg-3">
        <div class="avatar" style="width:162px; border: 1px #cccccc solid;">
            <img src="{{ $avatar or '/images/no_image.png' }}" style="width: 160px; height: 160px">
            <div class="edit_panel" style="position: absolute; margin-top:-30px;z-index: 100; border: 1px #cccccc solid;width:162px; height: 30px; text-align: center; background-color: black; opacity: 0.7; ">
                @if(isset($avatar))
                    <a href="{{ url('/user/avatar') }}" style="color: white">обновить фото</a><br>
                @else
                    <a href="{{ url('/user/avatar') }}" style="color: white">добавить фото</a>
                @endif
            </div>
        </div>

        <a href="{{ url('/user/edit') }}" >редактировать личные параметры</a><br>
        <a href="{{ url('/user/password') }}" >изменить пароль</a>
    </div>
       @yield('profile')
@endsection