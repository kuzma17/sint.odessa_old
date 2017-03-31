<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 31.03.17
 * Time: 10:54
 */

$user = Auth::user();
?>

<div id="orderModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-order">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Оформить заказ</h4>
            </div>

            <form name="order" method="post" class="form-horizontal" action="">
                <div class="form-group">
                    <label for="phone" class="col-md-3 control-label">Тип услуги <span class="red">*</span></label>

                    <div class="col-md-9">
                        <select name="type_order" class="form-control" autofocus>
                            <option value="">заправка картриджей</option>
                            <option value="">ремонт оргтехники</option>
                        </select>
                    </div>
                </div>



                <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Тип пользователя <span class="red">*</span></label>

                    <div class="col-md-8 form-inline">
                        <input type="radio" id="client_user" class="form-control" name="type_client" value="0" @if((isset($user->profile) && $user->profile->type_client == 0) || !isset($user->profile)) checked @endif> частное лицо
                        <input type="radio" id="client_company" class="form-control" name="type_client" value="1" @if(isset($user->profile) && $user->profile->type_client == 1) checked @endif> организация

                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label id="name_account" for="phone" class="col-md-3 control-label">@if((isset($user->profile) && $user->profile->type_client == 1 )) Компания @else ФИО @endif<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="name" value="{{ $user->name or '' }}" autofocus>
                        <p id="info_account">Фамилия Имя Отчество</p>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group client_company{{ $errors->has('user_company') ? ' has-error' : '' }}" @if((isset($user->profile) && $user->profile->type_client == 0 ) || !isset($user->profile)) style="display: none" @endif>
                    <label for="phone" class="col-md-3 control-label">Имя</label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="user_company" value="{{ $user->profile->user_company or '' }}" >
                        <p>Фамилия Имя Отчество контактного лица компании.</p>

                        @if ($errors->has('user_company'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('user_company') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="skype" class="col-md-3 control-label">E-mail <span class="red">*</span></label>

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
                    <label for="phone" class="col-md-3 control-label">телефон <span class="red">*</span></label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->profile->phone or '' }}" >

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-3 control-label">Адрес доставки</label>

                    <div class="col-md-9">
                        <input id="address" type="text" class="form-control" name="address" value="{{ $user->profile->address or '' }}" >

                        @if ($errors->has('address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="client_company" @if((isset($user->profile) && $user->profile->type_client == 0) || !isset($user->profile)) style="display: none" @endif>
                    <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-3 control-label">Форма оплаты <span class="red">*</span></label>

                        <div class="col-md-9 form-inline">
                            <input type="radio" id="payment_nal" class="form-control" name="type_payment" value="0" @if((isset($user->profile) && $user->profile->type_payment == 0) || !isset($user->profile)) checked @endif> наличный расчет
                            <input type="radio" id="payment_b_nal" class="form-control" name="type_payment" value="1" @if(isset($user->profile) && $user->profile->type_payment == 1) checked @endif> безналичны расчет
                            <input type="radio" id="payment_nds" class="form-control" name="type_payment" value="2" @if(isset($user->profile) && $user->profile->type_payment == 2) checked @endif> безналичный с НДС
                        </div>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-3 control-label">Комментарий</label>

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
