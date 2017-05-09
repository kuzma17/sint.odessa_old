<?php

namespace App\Http\Controllers;

use App\ActRepair;
use App\Order;
use App\TypeOrder;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_list(){
        $user = Auth::user();
        if($orders = Order::where('user_id', $user->id)->orderby('created_at', 'desc')->paginate(15)){
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
        $user = Auth::user();
        $type_order = TypeOrder::all();

        if($request->isMethod('post')){

            if($request->input('all_order')){
                //$user = Auth::user();
                //$type_order = TypeOrder::all();
                return view('order.order', ['order'=>$request, 'user' => $user, 'type_order' => $type_order]);
            }

            $list_validate = [
                'order_client_name' => 'required',
                'order_email' => 'required',
                'order_phone' => 'required',
                'order_address' => 'required'
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
            if($user->profile){
                $profile = $user->profile;
            }else{
                $profile = new UserProfile();
            }

            $order->user_id = $user->id;
            $profile->user_id = $user->id;

            $order->type_order_id = $request->input('type_order');

            $order->type_client_id = $request->input('order_type_client');
            $profile->type_client_id = $request->input('order_type_client');

            $order->client_name = $request->input('order_client_name');
            $profile->client_name = $request->input('order_client_name');

            $user->email = $request->input('order_email');

            $order->phone = $request->input('order_phone');
            $profile->phone = $request->input('order_phone');

            $order->address = $request->input('order_address');
            $profile->address = $request->input('order_address');

            if($order->type_client_id == 2) {

                $order->user_company = $request->input('order_user_company');
                $profile->user_company = $request->input('order_user_company');

                $order->type_payment_id = $request->input('order_type_payment');
                $profile->type_payment_id = $request->input('order_type_payment');

                if($order->type_payment_id == 2 || $order->type_payment_id == 3){

                    $order->company_full = $request->input('order_company_full');
                    $profile->company_full = $request->input('order_company_full');

                    $order->edrpou = $request->input('order_edrpou');
                    $profile->edrpou = $request->input('order_edrpou');

                    $order->code_index = $request->input('order_code_index');
                    $profile->code_index = $request->input('order_code_index');

                    $order->region = $request->input('order_region');
                    $profile->region = $request->input('order_region');

                    $order->area = $request->input('order_area');
                    $profile->area = $request->input('order_area');

                    $order->city = $request->input('order_city');
                    $profile->city = $request->input('order_city');

                    $order->street = $request->input('order_street');
                    $profile->street = $request->input('order_street');

                    $order->house = $request->input('order_house');
                    $profile->house = $request->input('order_house');

                    $order->house_block = $request->input('order_house_block');
                    $profile->house_block = $request->input('order_house_block');

                    $order->office = $request->input('order_office');
                    $profile->office = $request->input('order_office');
                }
                if($order->type_payment_id == 3){
                    $order->inn = $request->input('order_inn');
                    $profile->inn = $request->input('order_inn');
                }
            }
            $order->comment = $request->input('order_comment');

            $order->save();
            $profile->save();
            $user->save();

            Session::flash('ok_message', 'Ваш заказ успешно создан и будет рассмотрен в ближайшее время.');
            return redirect('/user/order/'.$order->id);
        }else {
            //$user = Auth::user();
            //$type_order = TypeOrder::all();
            return view('order.order', ['user' => $user, 'type_order' => $type_order]);
        }
    }

    public function user_consent(Request $request){
        $order_id = $request->input('order_id');
        $repair = ActRepair::where('order_id', $order_id)->first();
        $repair->user_consent_id = $request->input('user_consent');
        $repair->comment = $request->input('comment');
        $repair->save();
        Session::flash('ok_message', 'Ваш заказ успешно подтвержден и будет рассмотрен в ближайшее время.');
        return redirect('/user/order/'.$order_id);
    }

    public static function count_orders(){
        $this_date = date("Y-m-d", strtotime("-1 days"));
        $orders = Order::where('created_at', '>=', $this_date)->count();
        return $orders;
    }

    public static function count_day_orders(){

        for($i=30; $i >= 0; $i--){
            $min = $i + 1;
            $max = $i - 1;
            $date_min = date("Y-m-d", strtotime("-$min days"));
            $date_max = date("Y-m-d", strtotime("-$max days"));

            $oreders = Order::whereRaw("created_at > '$date_min' and created_at < '$date_max'")->count();

            $array_order[] = $oreders;
            $array_date[] = date("d.m", strtotime("-$i days"));
        }

        $adapt_data = [
            'dataArray' => json_encode( $array_order, JSON_UNESCAPED_UNICODE),
            'dateArray' => json_encode( $array_date, JSON_UNESCAPED_UNICODE),
            ];
        return $adapt_data;
    }
}
