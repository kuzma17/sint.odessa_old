@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Заказ №{{ $order->id }}</h4>

        @if($order->type_order_id == 3 && $order->type_status_id != 1)
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-1" data-toggle="tab">Заказ</a></li>
            <li><a href="#tab-2" data-toggle="tab">Акт ремонта</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-1">
                @endif
                <table class="table table-striped">
                    <tbody>
                    <tr><td >Статус:</td><td>{{ $order->status->name }}</td></tr>
                    <tr><td width="200">Тип услуги:</td><td>{{ $order->type_order->name }}</td></tr>
                    <tr><td>Тип пользователя:</td><td>{{ $order->type_client->name }}</td></tr>
                    <tr><td>ФИО(Имя):</td><td>{{ $order->client_name }}</td></tr>
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

                @if($order->type_order_id == 3 && $order->type_status_id != 1)
            </div>
            <div class="tab-pane fade" id="tab-2">
                <table class="table table-striped">
                    <tbody>
                    <tr><td >Оборудование:</td><td>{{ $order->act_repair->device }}</td></tr>
                    <tr><td width="200">Комплектация:</td><td>{{ $order->act_repair->set_device}}</td></tr>
                    <tr><td>Описание неисправности<br>(со слов заказчика):</td><td>{{ $order->act_repair->text_defect}}</td></tr>
                    <tr><td>Диагностика:</td><td>{{ $order->act_repair->diagnostic }}</td></tr>
                    <tr><td>Стоимость работы:</td><td>{{ $order->act_repair->cost }}</td></tr>
                    <tr><td>Подтверждение:</td><td><select name="user_consent" class="form-control">
                                @foreach(\App\UserConsent::all() as $consent)
                                <option value="{{ $consent->id }}">{{ $consent->name }}</option>
                                @endforeach
                            </select> </td></tr>
                    <tr><td >Комментарий:</td><td><textarea class="form-control" name="comment"></textarea></td></tr>
                    <tr><td>Подтверждение:</td><td><input type="submit" class="btn btn-primary" value="Отправить"></td></tr>
                    </tbody>
                </table>

            </div>
        </div>
            @endif

    </div>
@endsection