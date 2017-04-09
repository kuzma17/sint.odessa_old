@extends('user.app')
@section('profile')

    <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Параметры профиля</h4>

        <table class="table table-striped">
            <tbody>
            <tr><td>Тип пользователя:</td><td>{{ $user->profile->type_client->name }}</td></tr>
            <tr><td>ФИО(Имя):</td><td>{{ $user->name }}</td></tr>
            @if( $user->profile->type_client_id == 2 )
                <tr><td>ФИО представителя компании:</td><td>{{ $user->profile->user_company }}</td></tr>
            @endif
            <tr><td>Телефон:</td><td>{{ $user->profile->phone }}</td></tr>
            <tr><td>Адрес:</td><td>{{ $user->profile->address }}</td></tr>
            <tr><td >E-mail</td><td>{{ $user->email }}</td></tr>
            @if( $user->profile->type_client_id == 2 )
                <tr><td >Форма оплаты</td><td>{{ $user->profile->type_payment->name }}</td></tr>
                @if( $user->profile->type_payment_id == 2 ||  $user->profile->type_payment_id == 3)
                    <tr><td>Полное наименование организации:</td><td>{{ $user->profile->company_full }}</td></tr>
                    <tr><td>Код ЕДРПОУ:</td><td>{{ $user->profile->edrpou }}</td></tr>
                    @if($user->profile->type_payment_id == 3)
                        <tr><td>ИНН:</td><td>{{ $user->profile->inn }}</td></tr>
                    @endif
                    <tr><td>Почтовый индекс:</td><td>{{ $user->profile->code_index }}</td></tr>
                    <tr><td >Регион:</td><td>{{ $user->profile->region }}</td></tr>
                    <tr><td>Район:</td><td>{{ $user->profile->area }}</td></tr>
                    <tr><td>Город:</td><td>{{ $user->profile->city }}</td></tr>
                    <tr><td >Улица:</td><td>{{ $user->profile->street }}</td></tr>
                    <tr><td>Дом:</td><td>{{ $user->profile->house }}</td></tr>
                    <tr><td>Корпус:</td><td>{{ $user->profile->house_block }}</td></tr>
                    <tr><td >Квартира/офис:</td><td>{{ $user->profile->office }}</td></tr>
                @endif
            @endif
            </tbody>
        </table>
    </div>
@endsection