@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-8 col-lg-9">
        <ul style="margin-left: 0; list-style: none;">
            <li><strong>Имя:</strong> {{ $user->name or '' }}</li>
            <li><strong>адрес:</strong> {{ $user->profile->address or '' }}</li>
            <li><strong>телефон:</strong> {{ $user->profile->phone or ''}}</li>
            <li><strong>email:</strong> {{ $user->email }}</li>
            <li><strong>icq:</strong> {{ $user->profile->icq or '' }}</li>
            <li><strong>skype:</strong> {{ $user->profile->skype or '' }}</li>
        </ul>
    </div>
@endsection