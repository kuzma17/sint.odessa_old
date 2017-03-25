@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-8 col-lg-9">
        <ul style="margin-left: 0; list-style: none;">
            <li><strong>ник:</strong> {{ $user->name }}</li>
            <li><strong>ФИО:</strong> {{ $profile->fio or ''}}</li>
            <li><strong>адрес:</strong> {{ $profile->address or '' }}</li>
            <li><strong>телефон:</strong> {{ $profile->phone or ''}}</li>
            <li><strong>email:</strong> {{ $user->email }}</li>
            <li><strong>icq:</strong> {{ $profile->icq or '' }}</li>
            <li><strong>skype:</strong> {{ $profile->skype or '' }}</li>
        </ul>
    </div>
@endsection