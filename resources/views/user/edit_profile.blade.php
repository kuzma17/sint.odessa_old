@extends('user.app')
@section('profile')
        <div class="rcol-sm-6 col-md-8 col-lg-9">
        <h4>Редактирование профиля</h4>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">телефон</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $profile->phone or '' }}" required autofocus>

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('icq') ? ' has-error' : '' }}">
                    <label for="icq" class="col-md-4 control-label">icq</label>

                    <div class="col-md-6">
                        <input id="icq" type="text" class="form-control" name="icq" value="{{ $profile->icq or '' }}" required>

                        @if ($errors->has('icq'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('icq') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
                    <label for="skype" class="col-md-4 control-label">skype</label>

                    <div class="col-md-6">
                        <input id="skype" type="text" class="form-control" name="skype" value="{{ $profile->skype or '' }}" required>

                        @if ($errors->has('skype'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">адрес</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address" value="{{ $profile->address or '' }}" required>

                        @if ($errors->has('address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
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