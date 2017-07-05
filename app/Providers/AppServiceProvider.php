<?php

namespace App\Providers;

use App\ActRepair;
use App\CustomValidator;
use App\History;
use App\Notifications\CreatedOrder;
use App\Notifications\RegisterUser;
use App\Notifications\StatusOrder;
use App\Order;
use App\Status;
use App\StatusRepairs;
use App\User;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    protected $status_order;
    protected $status_repair;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages){
            return new CustomValidator($translator, $data, $rules, $messages);
        });

        User::created(function($user){
            $user->notify(new RegisterUser($user)); // Send email
        });

       Order::created(function($order){
           $history = new History();
           $history->order_id = $order->id;
           $history->status_info = 'Создан новый заказ № '.$order->id;
           $history->save();

           $order->notify(new CreatedOrder($order)); // Send email
       });

        Order::updating(function($order){
            $this->status_order = Order::find($order->id)->status_id;
        });

        Order::updated(function($order){
            if($order->status_id != $this->status_order){
                $history = new History();
                $history->order_id = $order->id;
                $history->admin_user = Admin::user()->name;
                $old_status = Status::find($this->status_order)->name_site;
                $new_status = Status::find($order->status_id)->name_site;
                $history->status_info = 'Изменен статус заказа: '.$old_status.' -> '.$new_status;
                $history->save();

                $order->notify(new StatusOrder($order, $new_status)); // Send email
            }
        });

        ActRepair::updating(function($repair){
            $this->status_repair = ActRepair::find($repair->id)->status_repair_id;
        });

        ActRepair::updated(function($repair){
            if($repair->status_repair_id != $this->status_repair){
                $history = new History();
                $history->order_id = $repair->order_id;
                $history->admin_user = Admin::user()->name;
                $old_status_repair = StatusRepairs::find($this->status_repair)->name_site;
                $new_status_repair= StatusRepairs::find($repair->status_repair_id)->name_site;
                $history->status_info = 'Изменен статус ремонта: '.$old_status_repair.' -> '.$new_status_repair;
                $history->save();

                $order = Order::find($repair->order_id);

                $repair->notify(new StatusOrder($order, $new_status_repair)); // Send email
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
