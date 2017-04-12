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

    public function is_open(){
        if($this->status_repair_id == 3 || $this->status_repair_id == 13){
            return true;
        }
        return false;
    }
}
