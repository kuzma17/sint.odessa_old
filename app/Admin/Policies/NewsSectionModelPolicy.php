<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\News;
use Illuminate\Auth\Access\HandlesAuthorization;
class NewsSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    // public function before(User $user, $ability, News $section, User $item = null)
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
    public function display(User $user, News $item)
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
    public function create(User $user, News $item)
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
    public function edit(User $user, News $item)
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
    public function delete(User $user, News $item)
    {
        if($user->isAdmin() || $user->isModerator()){
            return true;
        }
        return false;
    }
}