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

}
