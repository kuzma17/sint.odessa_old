@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-8 col-lg-9">
        <h4>Новый заказ</h4>


        <form class="form-horizontal"  role="form" method="POST" action="{{ url('/user/order/add') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('type_order') ? ' has-error' : '' }}">
                <label for="type_order_id" class="col-md-4 control-label">тип заказа</label>
                <div class="col-md-6" >
                    <select id="type_order_id" name="type_order_id" class="form-control" required autofocus>
                        @foreach($type_order as $type)
                            <option value="{{ $type->id }}">{{ $type->type_order }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type_order_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('type_order_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('type_order') ? ' has-error' : '' }}">
                <label for="comment" class="col-md-4 control-label">коментарий</label>
                <div class="col-md-6" >
                    <textarea id="comment" name="comment" class="form-control"></textarea>
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