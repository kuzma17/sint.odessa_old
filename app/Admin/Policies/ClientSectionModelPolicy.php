<?php
namespace App\Admin\Policies;
use App\User;
use App\Admin\Client;
use Illuminate\Auth\Access\HandlesAuthorization;
class ClientSectionModelPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @return bool
     */
   // public function before(User $user, $ability, Client $section, User $item = null)
   // {
     //   if($user->isAdmin()){
     //       return true;
      //  }
     //   return true;
   // }
    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function display(User $user, Client $item)
    {
        if($user->isAdmin() || $user->isManager()){
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
    public function create(User $user, Client $item)
    {
        if($user->isAdmin() || $user->isManager()){
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
    public function edit(User $user, Client $item)
    {
        if($user->isAdmin() || $user->isManager()){
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
    public function delete(User $user, Client $item)
    {
        if($user->isAdmin() || $user->isManager()){
            return true;
        }
        return false;
    }
}