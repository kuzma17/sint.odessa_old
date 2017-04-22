<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\Status;
use Illuminate\Auth\Access\HandlesAuthorization;
class StatusSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    // public function before(User $user, $ability, Status $section, User $item = null)
    /// {
    //   if($user->isAdmin()){
    //       return true;
    //  }
    //    return true;
    // }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, Status $item)
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
    public function create(User $user, Status $item)
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
    public function edit(User $user, Status $item)
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
    public function delete(User $user, Status $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
}