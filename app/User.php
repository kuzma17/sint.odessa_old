<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }
    /**
     * @return bool
     */
    public function isManager()
    {
        return $this->hasRole('manager');
    }

    public static function createBySocialProvider($providerUser)
    {
        return self::create([
            'email' => $providerUser->getEmail(),
            //'email' => 'tw', // IF Odnoklassniki
            //'username' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),
        ]);
    }

    //public static function avatar(){
      //  if($res = UserAvatar::find(Auth::user()->id)) {
        //    return $res->avatar;
       // }
    //}

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

}
