@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Заказ №{{ $order->id }}</h4>

        <table class="table table-striped">
            <tbody>
            <tr><td width="200">Тип услуги:</td><td>{{ $order->type_order->name }}</td></tr>
            <tr><td>Тип пользователя:</td><td>{{ $order->type_client->name }}</td></tr>
            <tr><td>ФИО(Имя):</td><td>{{ $user->name }}</td></tr>
            @if( $order->type_client_id == 2 )
                <tr><td>ФИО представителя компании:</td><td>{{ $order->	user_company }}</td></tr>
            @endif
            <tr><td>Телефон:</td><td>{{ $order->phone }}</td></tr>
            <tr><td>Адрес:</td><td>{{ $order->address }}</td></tr>
            <tr><td >E-mail</td><td>{{ $user->email }}</td></tr>
            @if( $order->type_client_id == 2 )
                <tr><td >Форма оплаты</td><td>{{ $order->type_payment->name }}</td></tr>
                @if( $order->type_payment_id == 2 ||  $order->type_payment_id == 3)
                    <tr><td>Полное наименование организации:</td><td>{{ $order->company_full }}</td></tr>
                    <tr><td>Код ЕДРПОУ:</td><td>{{ $order->edrpou }}</td></tr>
                    @if($order->type_payment_id == 3)
                        <tr><td>ИНН:</td><td>{{ $order->inn }}</td></tr>
                    @endif
                    <tr><td>Почтовый индекс:</td><td>{{ $order->code_index }}</td></tr>
                    <tr><td >Регион:</td><td>{{ $order->region }}</td></tr>
                    <tr><td>Район:</td><td>{{ $order->area }}</td></tr>
                    <tr><td>Город:</td><td>{{ $order->city }}</td></tr>
                    <tr><td >Улица:</td><td>{{ $order->street }}</td></tr>
                    <tr><td>Дом:</td><td>{{ $order->house }}</td></tr>
                    <tr><td>Корпус:</td><td>{{ $order->house_block }}</td></tr>
                    <tr><td >Квартира/офис:</td><td>{{ $order->office }}</td></tr>
                @endif
            @endif
            <tr><td >Комментарий:</td><td>{{ $order->comment }}</td></tr>
            </tbody>
        </table>
    </div>
@endsection