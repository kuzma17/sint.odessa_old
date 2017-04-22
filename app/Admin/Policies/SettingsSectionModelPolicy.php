<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\Settings;
use Illuminate\Auth\Access\HandlesAuthorization;
class SettingsSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    //public function before(User $user, $ability, Users $section, User $item = null)
    // {
    //    if($user->isAdmin()){
    //      return true;
    //     }
    //  return true;
    // }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, Settings $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function create(User $user, Settings $item)
    {
        return false;
    }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, Settings $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function delete(User $user, Settings $item)
    {
        return false;
    }
}