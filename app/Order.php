<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function type_order(){
        return $this->belongsTo('App\Type_order');
    }
}
