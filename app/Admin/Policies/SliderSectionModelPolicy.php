<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\Slider;
use Illuminate\Auth\Access\HandlesAuthorization;
class SliderSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
    // public function before(User $user, $ability, Slider $section, User $item = null)
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
    public function display(User $user, Slider $item)
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
    public function create(User $user, Slider $item)
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
    public function edit(User $user, Slider $item)
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
    public function delete(User $user, Slider $item)
    {
        if($user->isAdmin()){
            return true;
        }
        return false;
    }
}