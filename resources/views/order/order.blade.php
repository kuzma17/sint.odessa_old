@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>Оформление заказа</h3>
        <form name="order_order" method="post" class="form-horizontal" action="{{ url('/order') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label  class="col-md-3 control-label">Тип услуги <span class="red">*</span></label>

                <div class="col-md-9">
                    <select name="type_order" class="form-control">
                        @foreach($type_order as $type)
                            <option value="{{ $type->id }}" @if((old() && $type->id == old('type_order')) || (!old() && isset($order) && $type->id == $order->type_order)) selected="selected" @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="form-group{{ $errors->has('order_fio') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">Тип пользователя <span class="red">*</span></label>

                <div class="col-md-8 form-inline">
                    <input type="radio" class="form-control type_user" name="order_type_client" value="1" @if((old() && old('order_type_client') == 1) || (!old() && isset($order) && $order->order_type_client == 1)) checked @endif> частное лицо
                    <input type="radio" class="form-control type_company" name="order_type_client" value="2" @if((old() && old('order_type_client') == 2) || (!old() && isset($order) && $order->order_type_client == 2)) checked @endif> организация

                </div>
            </div>
            <div class="form-group{{ $errors->has('order_name') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label name_account">@if((old() && old('order_type_client') == 2) || (!old() && isset($order) && $order->order_type_client == 2)) Компания @else ФИО @endif<span class="red">*</span></label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="order_name" value="{{ $user->name }}" autofocus>
                    <p class="info_account">Фамилия Имя Отчество</p>

                    @if ($errors->has('order_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group client_company_order{{ $errors->has('order_user_company') ? ' has-error' : '' }}" @if((old() && old('order_type_client') == 1) || (!old() && isset($order) && $order->order_type_client == 1 )) style="display: none" @endif>
                <label  class="col-md-3 control-label">Имя</label>

                <div class="col-md-9">
                    <input id="user_company" type="text" class="form-control" name="order_user_company" value="@if(old()){{ old('order_user_company') }}@else{{ $order->order_user_company or '' }}@endif" >
                    <p>Фамилия Имя Отчество контактного лица компании.</p>

                    @if ($errors->has('order_user_company'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_user_company') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_email') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">E-mail <span class="red">*</span></label>

                <div class="col-md-9">
                    <input id="skype" type="text" class="form-control" name="order_email" value="{{ $user->email or '' }}" disabled>

                    @if ($errors->has('order_email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_phone') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">телефон <span class="red">*</span></label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="order_phone" value="@if(old()){{ old('order_phone') }}@else{{ $order->order_phone or '' }}@endif" >

                    @if ($errors->has('order_phone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_address') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Адрес доставки</label>

                <div class="col-md-9">
                    <input type="text" class="form-control" name="order_address" value="@if(old()){{ old('order_address') }}@else{{ $order->order_address or '' }}@endif" >

                    @if ($errors->has('order_address'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_address') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="client_company_order" @if((old() && old('order_type_client') == 1) || (!old() && isset($order) && $order->order_type_client == 1))  style="display: none" @endif>
                <div class="form-group{{ $errors->has('order_fio') ? ' has-error' : '' }}">
                    <label  class="col-md-3 control-label">Форма оплаты <span class="red">*</span></label>

                    <div class="col-md-9 form-inline">
                        <input type="radio" id="payment_nal" class="form-control" name="order_type_payment" value="1" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) checked @endif> наличный расчет
                        <input type="radio" id="payment_b_nal" class="form-control" name="order_type_payment" value="2" @if((old() && old('order_type_payment') == 2) || (!old() && isset($order) && $order->order_type_payment == 2)) checked @endif> безналичны расчет
                        <input type="radio" id="payment_nds" class="form-control" name="order_type_payment" value="3" @if((old() && old('order_type_payment') == 3) || (!old() && isset($order) && $order->order_type_payment == 3)) checked @endif> безналичный с НДС
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_company_full') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Компания<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_company_full" value="@if(old()){{ old('order_company_full') }}@else{{ $user->profile->company_full or '' }}@endif" >
                        <p>Полное наименование организации (согласно выписке из госреестра) </p>

                        @if ($errors->has('order_company_full'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_company_full') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_edrpou') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label class="col-md-3 control-label">Код ЕДРПОУ <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_edrpou" value="@if(old()){{ old('order_edrpou') }}@else{{ $user->profile->edrpou or '' }}@endif" >
                        <p>Должен содержать 8 - 10 знаков</p>

                        @if ($errors->has('order_edrpou'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_edrpou') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_nds{{ $errors->has('order_inn') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') != 3) || (!old() && isset($order) && $order->order_type_payment !=3)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">ИНН<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_inn" value="@if(old()){{ old('order_inn') }}@else{{ $user->profile->inn or '' }}@endif" >
                        <p>Индивидуальный налоговый номер, должен содержать 10 знаков</p>

                        @if ($errors->has('order_inn'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_inn') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_code_index') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Индекс <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_code_index" value="@if(old()){{ old('order_code_index') }}@else{{ $user->profile->code_index or '' }}@endif" >
                        <p>Почтовый индекс, должен содержать 5 знаков</p>

                        @if ($errors->has('order_code_index'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_code_index') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_region') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Регион</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_region" value="@if(old()){{ old('order_region') }}@else{{ $user->profile->region or '' }}@endif" >

                        @if ($errors->has('order_region'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_region') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_area') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Район</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_area" value="@if(old()){{ old('order_area') }}@else{{ $user->profile->area or '' }}@endif" >

                        @if ($errors->has('order_area'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_area') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_city') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Город <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_city" value="@if(old()){{ old('order_city') }}@else{{ $user->profile->city or '' }}@endif" >

                        @if ($errors->has('order_city'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_street') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Улица <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_street" value="@if(old()){{ old('order_street') }}@else{{ $user->profile->street or '' }}@endif" >

                        @if ($errors->has('order_street'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_street') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_house') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Дом <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_house" value="@if(old()){{ old('order_house') }}@else{{ $user->profile->house or '' }}@endif" >

                        @if ($errors->has('order_house'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_house') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_house_block') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Корпус</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_house_block" value="@if(old()){{ old('order_house_block') }}@else{{ $user->profile->house_block or '' }}@endif" >

                        @if ($errors->has('order_house_block'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_house_block') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_office') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Квартира/офис</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_office" value="@if(old()){{ old('order_office') }}@else{{ $user->profile->office or '' }}@endif" >

                        @if ($errors->has('order_office'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_office') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_comment') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Комментарий</label>

                <div class="col-md-9">
                    <textarea class="form-control" name="order_comment">@if(old()){{ old('order_comment') }}@else{{ $order->order_comment or ''}}@endif</textarea>

                    @if ($errors->has('order_comment'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_comment') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <input type="submit" class="btn btn-primary" name="add_all_order" value="Сохранить">
                </div>
            </div>
        </form>

    </div>
@endsection