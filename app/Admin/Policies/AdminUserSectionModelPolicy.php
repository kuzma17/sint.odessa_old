<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;
class AdminUserSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, AdminUser $item)
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
    public function create(User $user, AdminUser $item)
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
    public function edit(User $user, AdminUser $item)
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
    public function delete(User $user, AdminUser $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
}