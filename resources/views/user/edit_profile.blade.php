@extends('user.app')
@section('profile')
        <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Редактирование профиля</h4>
        <p>поля отмеченные звездочкой <span class="red">*</span> обязательны для заполнения</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Тип пользователя <span class="red">*</span></label>

                    <div class="col-md-8 form-inline">
                        <input type="radio" id="client_user" class="form-control" name="type_client" value="1" @if((old() && old('type_client') == 1) || (isset($user->profile) && !old() && $user->profile->type_client_id == 1) || !isset($user->profile)) checked @endif> частное лицо
                        <input type="radio" id="client_company" class="form-control" name="type_client" value="2" @if((old() && old('type_client') == 2) || (isset($user->profile) && !old() && $user->profile->type_client_id == 2)) checked @endif> организация

                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label id="name_account" for="phone" class="col-md-3 control-label">@if((old() && old('type_client') == 2) || (isset($user->profile) && !old() && $user->profile->type_client_id == 2 )) Компания @else ФИО @endif<span class="red">*</span></label>

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
                <div class="form-group client_company{{ $errors->has('user_company') ? ' has-error' : '' }}" @if(old() && old('type_client') == 1 || (!old() && isset($user->profile) && $user->profile->type_client_id == 1 ) || !isset($user->profile)) style="display: none" @endif>
                    <label for="phone" class="col-md-3 control-label">Имя</label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="user_company" value="@if(old()){{ old('user_company') }}@else{{ $user->profile->user_company or '' }}@endif" >
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
                        <input id="phone" type="text" class="form-control" name="phone" value="@if(old()){{ old('phone') }}@else{{ $user->profile->phone or '' }}@endif" >

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
                        <input id="address" type="text" class="form-control" name="address" value="@if(old()){{ old('address') }}@else{{ $user->profile->address or '' }}@endif" >

                        @if ($errors->has('address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="client_company" @if((old() && old('type_client') == 1) || (!old() && isset($user->profile) && $user->profile->type_client_id == 1) || !isset($user->profile)) style="display: none" @endif>
                    <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-3 control-label">Форма оплаты <span class="red">*</span></label>

                        <div class="col-md-9 form-inline">
                            <input type="radio" id="payment_nal" class="form-control" name="type_payment" value="1" @if((old() && old('type_payment') == 1) || (isset($user->profile) && !old() && $user->profile->type_payment_id == 1) || !isset($user->profile)) checked @endif> наличный расчет
                            <input type="radio" id="payment_b_nal" class="form-control" name="type_payment" value="2" @if((old() && old('type_payment') == 2) || (isset($user->profile) && !old() && $user->profile->type_payment_id == 2)) checked @endif> безналичны расчет
                            <input type="radio" id="payment_nds" class="form-control" name="type_payment" value="3" @if((old() && old('type_payment') == 3) || (isset($user->profile) && !old() && $user->profile->type_payment_id == 3)) checked @endif> безналичный с НДС
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('company_full') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="phone" class="col-md-3 control-label">Компания<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="phone" type="text" class="form-control" name="company_full" value="@if(old()){{ old('company_full') }}@else{{ $user->profile->company_full or '' }}@endif" >
                            <p>Полное наименование организации (согласно выписке из госреестра) </p>

                            @if ($errors->has('company_full'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('company_full') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('edrpou') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="icq" class="col-md-3 control-label">Код ЕДРПОУ <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="icq" type="text" class="form-control" name="edrpou" value="@if(old()){{ old('edrpou') }}@else{{ $user->profile->edrpou or '' }}@endif" >
                            <p>Должен содержать 8 - 10 знаков</p>

                            @if ($errors->has('edrpou'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('edrpou') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_nds{{ $errors->has('inn') ? ' has-error' : '' }}" @if((old() && old('type_payment') != 3) || (!old() && isset($user->profile) && $user->profile->type_payment_id != 3) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">ИНН<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="inn" value="@if(old()){{ old('inn') }}@else{{ $user->profile->inn or '' }}@endif" >
                            <p>Индивидуальный налоговый номер, должен содержать 10 знаков</p>

                            @if ($errors->has('inn'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('inn') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('code_index') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Индекс <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="code_index" value="@if(old()){{ old('code_index') }}@else{{ $user->profile->code_index or '' }}@endif" >
                            <p>Почтовый индекс, должен содержать 5 знаков</p>

                            @if ($errors->has('code_index'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code_index') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('region') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Регион</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="region" value="@if(old()){{ old('region') }}@else{{ $user->profile->region or '' }}@endif" >

                            @if ($errors->has('region'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('area') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Район</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="area" value="@if(old()){{ old('area') }}@else{{ $user->profile->area or '' }}@endif" >

                            @if ($errors->has('area'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('city') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Город <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="city" value="@if(old()){{ old('city') }}@else{{ $user->profile->city or '' }}@endif" >

                            @if ($errors->has('city'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('street') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Улица <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="street" value="@if(old()){{ old('street') }}@else{{ $user->profile->street or '' }}@endif" >

                            @if ($errors->has('street'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('house') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Дом <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="house" value="@if(old()){{ old('house') }}@else{{ $user->profile->house or '' }}@endif" >

                            @if ($errors->has('house'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('house_block') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Корпус</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="house_block" value="@if(old()){{ old('house_block') }}@else{{ $user->profile->house_block or '' }}@endif" >

                            @if ($errors->has('house_block'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('house_block') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('office') ? ' has-error' : '' }}" @if((old() && old('type_payment') == 1) || (!old() && isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Квартира/офис</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="office" value="@if(old()){{ old('office') }}@else{{ $user->profile->office or '' }}@endif" >

                            @if ($errors->has('office'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                            @endif
                        </div>
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