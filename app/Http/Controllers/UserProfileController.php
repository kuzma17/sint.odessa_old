<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use App\UserAvatar;
use App\UserProfile;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;

class UserProfileController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function profile(){
        $user = Auth::user();
        return view('user.profile', ['user'=>$user]);
    }

    public function edit(Request $request){
        $user = Auth::user();
        $profile = $user->profile;
        if($request->isMethod('post')) {
                $this->validate($request, [
                    'fio' => 'required',
                //'name' => 'required|max:200',
                'phone' => 'required|max:20',
                'address' => 'required'
            ]);
                if($user->profile){
                    $profile = $user->profile;;
                }else{
                    $profile = new UserProfile();
                }
                $profile->id = $user->id;
            $profile->fio = $request->input('fio');
            $profile->phone = $request->input('phone');
            $profile->icq = $request->input('icq');
            $profile->skype = $request->input('skype');
            $profile->address = $request->input('address');
            $profile->save();
            Session::flash('ok_message', 'Данные Вашего профиля успещно сохранены.');
                return $this->profile();
        }else {
                return view('user.edit_profile', ['profile' => $profile]);
        }
    }

    public function avatar_(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')) {
            //if($request->file('avatar')->isValid()) {
            //}
            $this->validate($request, [
                'avatar'  =>  'required|image|max:100',
            ]);
                $image = $request->file('avatar');
                Image::make($image->getRealPath())->resize(160, 160)->save();
                $saveImageName = str_random(10) . '.' . $image->getClientOriginalExtension();

            if(UserAvatar::find($user->id)) {
                $avatar = UserAvatar::find($user->id);
            }else{
               $avatar = new UserAvatar();
            }
            $avatar->id = $user->id;
                $avatar->avatar = $image->move('images/avatars', $saveImageName);
                $avatar->save();
            Session::flash('ok_message', 'Ваше фото успешно соxранено.');
            return $this->profile();
        }else{
            return view('user.edit_avatar');
        }
    }

    public function avatar(Request $request){
        $user = Auth::user();
        if($request->isMethod('post')) {

            $this->validate($request, [
                'avatar'  =>  'required|image|max:100',
            ]);
            $image = $request->file('avatar');
            Image::make($image->getRealPath())->resize(160, 160)->save();
            $saveImageName = str_random(10) . '.' . $image->getClientOriginalExtension();

            if($user->profile) {
                $profile = $user->profile;;
            }else{
                $profile = new UserProfile();
            }
            $profile->avatar = $image->move('images/avatars', $saveImageName);
            $profile->save();
            Session::flash('ok_message', 'Ваше фото успешно соxранено.');
            return $this->profile();
        }else{
            return view('user.edit_avatar');
        }
    }

    public function dell_avatar(){
        $user = Auth::user();
        UserAvatar::destroy($user->id);
        Session::flash('ok_message', 'Ваше фото успешно удалено.');
            return $this->profile();
    }

    public function edit_password(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'old_password' => 'required|oldpassword',
                'password'  =>  'required|min:6|confirmed',
            ]);
            //if(Hash::check($request->old_password, Auth::user()->password)){
                $tek_user = User::find(Auth::id());
                $tek_user->password = Hash::make($request->password);
                $tek_user->save();
                Session::flash('ok_message', 'Ваш пароль успешно изменен.');
            return $this->profile();
           //}
        }else{
            return view('user.edit_password');
        }
    }

}
