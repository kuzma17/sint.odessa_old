<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 31.03.17
 * Time: 10:54
 */

$user = Auth::user();
$type_order = \App\Type_order::all();
?>

<div id="orderModal" class="modal fade">
    <div class="modal-dialog" style="width: 700px">
        <div class="modal-content modal-order">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Оформить заказ</h4>
            </div>
s
            <form name="order" method="post" class="form-horizontal" action="{{ url('/order') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-3 control-label">Тип услуги <span class="red">*</span></label>

                    <div class="col-md-9">
                        <select name="type_order" class="form-control" autofocus>
                            @foreach($type_order as $type)
                                <option value="{{ $type->id }}">{{ $type->type_order }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-4 control-label">Тип пользователя <span class="red">*</span></label>

                    <div class="col-md-8 form-inline">
                        <input type="radio" class="form-control type_user" name="order_type_client" value="0" @if((isset($user->profile) && $user->profile->type_client == 0) || !isset($user->profile)) checked @endif> частное лицо
                        <input type="radio" class="form-control type_company" name="order_type_client" value="1" @if(isset($user->profile) && $user->profile->type_client == 1) checked @endif> организация

                    </div>
                </div>
                <div class="form-group{{ $errors->has('order_name') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label name_account">@if((isset($user->profile) && $user->profile->type_client == 1 )) Компания @else ФИО @endif<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="order_name" value="{{ $user->name or '' }}" autofocus>
                        <p class="info_account">Фамилия Имя Отчество</p>

                        @if ($errors->has('order_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group client_company_order{{ $errors->has('order_user_company') ? ' has-error' : '' }}" @if((isset($user->profile) && $user->profile->type_client == 0 ) || !isset($user->profile)) style="display: none" @endif>
                    <label for="phone" class="col-md-3 control-label">Имя</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="order_user_company" value="{{ $user->profile->user_company or '' }}" >
                        <p>Фамилия Имя Отчество контактного лица компании.</p>

                        @if ($errors->has('order_user_company'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_user_company') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('order_email') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">E-mail <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="order_email" value="{{ $user->email or '' }}" disabled>

                        @if ($errors->has('order_email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('order_phone') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">телефон <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="order_phone" value="{{ $user->profile->phone or '' }}" >

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
                        <input  type="text" class="form-control" name="order_address" value="{{ $user->profile->address or '' }}" >

                        @if ($errors->has('order_address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_address') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="client_company_order" @if((isset($user->profile) && $user->profile->type_client == 0) || !isset($user->profile)) style="display: none" @endif>
                    <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Форма оплаты <span class="red">*</span></label>

                        <div class="col-md-9 form-inline">
                            <input type="radio" id="payment_nal" class="form-control" name="order_type_payment" value="0" @if((isset($user->profile) && $user->profile->type_payment == 0) || !isset($user->profile)) checked @endif> наличный расчет
                            <input type="radio" id="payment_b_nal" class="form-control" name="order_type_payment" value="1" @if(isset($user->profile) && $user->profile->type_payment == 1) checked @endif> безналичны расчет
                            <input type="radio" id="payment_nds" class="form-control" name="order_type_payment" value="2" @if(isset($user->profile) && $user->profile->type_payment == 2) checked @endif> безналичный с НДС
                        </div>
                        <p style="font-family: Arial; size: 10px; font-style: italic">При оформлении заказа за безналичны расчет и безналичный с НДС необходимо внести дополнительную информацию.
                        Наш менеджер свяжется с Вами и возьмет всю небходимую информацию.
                        Также Вы можете сами внести все недостающие данные, воспользовавшись <a href="{{ url('order') }}" >расшыренным заказом</a>.</p>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label class="col-md-3 control-label">Комментарий</label>

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
            <div class="modal-footer">
                <a href="{{ url('order') }}" >перейти в расшыренный заказ</a>
                <button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
        </div>
    </div>
</div>
