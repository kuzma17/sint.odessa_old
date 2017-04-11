<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActRepair extends Model
{
    protected $table = 'act_repairs';

    public function status_repair(){
        return $this->belongsTo('App\StatusRepair');
    }

    public function user_consent(){
        return $this->belongsTo('App\UserConsent');
    }
}
