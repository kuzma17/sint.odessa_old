<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function type_order(){
        return $this->belongsTo('App\Type_order');
    }

    public function type_client(){
        return $this->belongsTo('App\Type_client');
    }

    public function type_payment(){
        return $this->belongsTo('App\Type_payment');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }
}
