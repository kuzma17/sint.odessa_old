@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Заказы</h4>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>тип заказа</th>
                <th>дата</th>
                <th>статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="link_order" onclick="document.location.href='{{ url('/user/order/'.$order->id) }}'">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->type_order->name }}</td>
                    <td>{{ date_format($order->created_at, "d.m.Y") }}</td>
                    <td>{{ $order->status->name }}</td>
                    <td></td>
                </tr>
             @endforeach
            </tbody>
        </table>
    </div>
@endsection