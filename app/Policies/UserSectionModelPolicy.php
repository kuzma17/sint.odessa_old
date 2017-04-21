<?php
namespace App\Policies;
use App\User;
use App\Http\Admin\User as Users;
use Illuminate\Auth\Access\HandlesAuthorization;
class UserSectionModelPolicy
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
    public function display(User $user, Users $item)
    {
        //if($user->isAdmin()){
          //  return true;
        //}
        return true;
    }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, Users $item)
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
    public function delete(User $user, Users $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
}