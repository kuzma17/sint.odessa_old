<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\Page;
use Illuminate\Auth\Access\HandlesAuthorization;
class PageSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    // public function before(User $user, $ability, Order $section, User $item = null)
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
    public function display(User $user, Page $item)
    {
        if($user->isAdmin() || $user->isModerator()){
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
    public function create(User $user, Page $item)
    {
        if($user->isAdmin() || $user->isModerator()){
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
    public function edit(User $user, Page $item)
    {
        if($user->isAdmin() || $user->isModerator()){
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
    public function delete(User $user, Page $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
}