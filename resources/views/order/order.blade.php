@extends('layouts.app')

@section('content')
    <div class="content-page">

        <h3>Оформление заказа</h3>
        <form name="order" method="post" class="form-horizontal" action="{{ url('/order') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label  class="col-md-3 control-label">Тип услуги <span class="red">*</span></label>

                <div class="col-md-9">
                    <select name="type_order" class="form-control">
                        @foreach($type_order as $type)
                            <option value="{{ $type->id }}" @if(isset($order) && $type->id == $order->type_order_id) selected="selected" @endif>{{ $type->type_order }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">Тип пользователя <span class="red">*</span></label>

                <div class="col-md-8 form-inline">
                    <input type="radio" class="form-control type_user" name="type_client" value="0" @if(isset($order) && $order->type_client == 0) checked @endif> частное лицо
                    <input type="radio" class="form-control type_company" name="type_client" value="1" @if(isset($order) && $order->type_client == 1) checked @endif> организация

                </div>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label name_account">@if(isset($order) && $order->type_client == 1) Компания @else ФИО @endif<span class="red">*</span></label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="name" value="{{ $user->name or '' }}" autofocus>
                    <p class="info_account">Фамилия Имя Отчество</p>

                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group client_company_order{{ $errors->has('user_company') ? ' has-error' : '' }}" @if(isset($order) && $order->type_client == 0 ) style="display: none" @endif>
                <label  class="col-md-3 control-label">Имя</label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="user_company" value="{{ $order->user_company or '' }}" >
                    <p>Фамилия Имя Отчество контактного лица компании.</p>

                    @if ($errors->has('user_company'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('user_company') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">E-mail <span class="red">*</span></label>

                <div class="col-md-9">
                    <input id="skype" type="text" class="form-control" name="email" value="{{ $user->email or '' }}" disabled>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">телефон <span class="red">*</span></label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="phone" value="{{ $order->phone or '' }}" >

                    @if ($errors->has('phone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Адрес доставки</label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="address" value="{{ $order->address or '' }}" >

                    @if ($errors->has('address'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="client_company_order" @if(isset($order) && $order->type_client == 0)  style="display: none" @endif>
                <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                    <label  class="col-md-3 control-label">Форма оплаты <span class="red">*</span></label>

                    <div class="col-md-9 form-inline">
                        <input type="radio" id="payment_nal" class="form-control" name="type_payment" value="0" @if(isset($order) && $order->type_payment == 0) checked @endif> наличный расчет
                        <input type="radio" id="payment_b_nal" class="form-control" name="type_payment" value="1" @if(isset($order) && $order->type_payment == 1) checked @endif> безналичны расчет
                        <input type="radio" id="payment_nds" class="form-control" name="type_payment" value="2" @if(isset($order) && $order->type_payment == 2) checked @endif> безналичный с НДС
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('company_full') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Компания<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="company_full" value="{{ $user->profile->company_full or '' }}" >
                        <p>Полное наименование организации (согласно выписке из госреестра) </p>

                        @if ($errors->has('company_full'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('company_full') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('edrpou') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label class="col-md-3 control-label">Код ЕДРПОУ <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="edrpou" value="{{ $user->profile->edrpou or '' }}" >
                        <p>Должен содержать 8 - 10 знаков</p>

                        @if ($errors->has('edrpou'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('edrpou') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_nds{{ $errors->has('inn') ? ' has-error' : '' }}" @if(isset($order) && ($order->type_payment == 0 || $order->type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">ИНН<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="inn" value="{{ $user->profile->inn or '' }}" >
                        <p>Индивидуальный налоговый номер, должен содержать 10 знаков</p>

                        @if ($errors->has('inn'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('inn') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('code_index') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Индекс <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="code_index" value="{{ $user->profile->code_index or '' }}" >
                        <p>Почтовый индекс, должен содержать 5 знаков</p>

                        @if ($errors->has('code_index'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('code_index') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('region') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Регион</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="region" value="{{ $user->profile->region or '' }}" >

                        @if ($errors->has('region'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('area') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Район</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="area" value="{{ $user->profile->area or '' }}" >

                        @if ($errors->has('area'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('city') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Город <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="city" value="{{ $user->profile->city or '' }}" >

                        @if ($errors->has('city'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('street') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Улица <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="street" value="{{ $user->profile->street or '' }}" >

                        @if ($errors->has('street'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('house') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Дом <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="house" value="{{ $user->profile->house or '' }}" >

                        @if ($errors->has('house'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('house_block') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Корпус</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="house_block" value="{{ $user->profile->house_block or '' }}" >

                        @if ($errors->has('house_block'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('house_block') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('office') ? ' has-error' : '' }}" @if(isset($order) && $order->type_payment == 0) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Квартира/офис</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="office" value="{{ $user->profile->office or '' }}" >

                        @if ($errors->has('office'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Комментарий</label>

                <div class="col-md-9">
                    <textarea class="form-control" name="comment"></textarea>

                    @if ($errors->has('comment'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection