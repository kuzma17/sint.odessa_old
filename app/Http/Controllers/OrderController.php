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
    public function order_list(){
        $user = Auth::user();
        if($orders = Order::where('user_id', $user->id)->orderby('created_at', 'desc')->get()){
            return view('user.order_list', ['orders'=>$orders]);
        }else{
            Session::flash('ok_message', 'У Вас пока нет сохраненных заказов.');
            return redirect('/user');
        }
    }

    public function order($id){
        $user = Auth::user();
        $order = Order::where('id', $id)->first();
        return view('user.order', ['user'=>$user, 'order'=>$order]);
    }

    public function add_order(Request $request){
        if($request->isMethod('post')){

            if($request->input('all_order')){
                $user = Auth::user();
                $type_order = Type_order::all();
                return view('order.order', ['order'=>$request, 'user' => $user, 'type_order' => $type_order]);
            }

            $list_validate = [
                'order_name' => 'required',
                //'order_email' => 'required',
                'order_phone' => 'required'
            ];

            if($request->input('add_all_order')){
                if($request->input('order_type_payment') == 2 || $request->input('order_type_payment') == 3) {
                    $list_validate += [
                        'order_company_full' => 'required',
                        'order_edrpou' => 'required|min:8|max:10',
                        'order_code_index' => 'required|size:5',
                        'order_city' => 'required',
                        'order_street' => 'required',
                        'order_house' => 'required',
                    ];
                }
                if( $request->input('order_type_payment') == 3){
                    $list_validate += [
                        'order_inn' => 'required|size:10',
                    ];
                }
            }

            $this->validate($request, $list_validate );

            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->type_order_id = $request->input('type_order');
            $order->type_client_id = $request->input('order_type_client');
            $order->phone = $request->input('order_phone');
            $order->address = $request->input('order_address');
            //$order->name = $request->input('order_name');
            if($order->type_client_id == 2) {
                $order->user_company = $request->input('order_user_company');
                $order->type_payment_id = $request->input('order_type_payment');

                if($order->type_payment_id == 2 || $order->type_payment_id == 3){
                    $order->company_full = $request->input('order_company_full');
                    $order->edrpou = $request->input('order_edrpou');
                    $order->code_index = $request->input('order_code_index');
                    $order->region = $request->input('order_region');
                    $order->area = $request->input('order_area');
                    $order->city = $request->input('order_city');
                    $order->house = $request->input('order_house');
                    $order->house_block = $request->input('order_house_block');
                    $order->office = $request->input('order_office');
                }
                if($order->type_payment_id == 3){
                    $order->inn = $request->input('order_inn');
                }
            }
            $order->comment = $request->input('order_comment');

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
