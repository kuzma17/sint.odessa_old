<?php
namespace App\Services;

use App\UserAvatar;
use App\UserProfile;
use App\UserSocialAccount;
use App\User;

class SocialAccountService
{
    public function createOrGetUser($providerObj, $providerName){

        $providerUser = $providerObj->user();

        $account = UserSocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new UserSocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName]);

            $profile = new UserAvatar([
                'avatar' => $providerUser->getAvatar()]); // User Profile

           // if (!$user) {
                $user = User::createBySocialProvider($providerUser);
           // }

            $account->user()->associate($user);
            $account->save();
            $profile->user()->associate($user);
            $profile->save();

            return $user;
        }

    }
}