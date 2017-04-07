<?php

namespace App\Http\Controllers;

use App\Order;
use App\Type_order;
use App\User;
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

    public function add_order_modal(Request $request){
        if($request->isMethod('post')){

            $list_validate = [
                'order_name' => 'required',
                //'order_email' => 'required',
                'order_phone' => 'required'
            ];

            $this->validate($request, $list_validate );

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->type_order_id = $request->input('type_order');
            $order->type_client = $request->input('order_type_client');
            //$order->name = $request->input('order_name');
            $order->user_company = $request->input('order_user_company');
            $order->phone = $request->input('order_phone');
            $order->address = $request->input('order_address');
            $order->type_payment = $request->input('order_type_payment');
            $order->comment = $request->input('comment');

            if($request->input('all_order')){
                $user = Auth::user();
                $type_order = Type_order::all();

                return view('order.order', ['order'=>$order, 'user' => $user, 'type_order' => $type_order]);
            }

            $order->save();

            Session::flash('ok_message', 'Ваш заказ успешно создан и будет рассмотрн в ближайшее время.');
            return redirect('/user');
        }else {
            $user = Auth::user();
            $type_order = Type_order::all();
            return view('order.order', ['user' => $user, 'type_order' => $type_order]);
        }
    }
}
