@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-8 col-lg-9">
        <h4>Заказы</h4>

        <table class="order" border="1">
            <ht>
                <td>№</td><td>тип работ</td><td>статус</td><td>дата заказа</td><td>дата выполн.</td>
            </ht>
            <?php $i = 1; ?>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $order->type_order->type_order }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->date_end }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </table>

    </div>


@endsection