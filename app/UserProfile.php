<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
       'user_id', 'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
