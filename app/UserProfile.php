<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
       'user_id', 'fio', 'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
