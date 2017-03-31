<?php

namespace App\Http\Controllers;

use App\Order;
use App\Type_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order(){
        $user = Auth::user();
        if($orders = Order::all()->where('user_id', $user->id)){
            return view('order.order', ['orders'=>$orders]);
        }else{
            Session::flash('ok_message', $user->id);
            return redirect('/user');
        }
    }

    public function add_order_(Request $request){
        if($request->isMethod('post')){
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->type_order_id = $request->input('type_order_id');
            $order->comment = $request->input('comment');
            $order->save();
            Session::flash('ok_message', 'Ваш заказ успешно создан и будет рассмотрн в ближайшее время.');
            return redirect('/user');
        }else {
            $type_order = Type_order::all();
            return view('order.add', ['type_order' => $type_order]);
        }
    }

    public function add_order(){
        $user = Auth::user();
        return view('order.order', ['user' => $user]);
    }
}
