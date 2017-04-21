<?php
namespace App\Policies;

use App\Post;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
class PostPolicy
{
    use HandlesAuthorization;
    /**
     * @param User   $user
     * @param string $ability
     *
     * @param Role   $item
     *
     * @return bool
     */


    /**
     * @param Administrator $administrator
     * @param Post $post
     * @return bool
     * @internal param User $user
     * @internal param Role $item
     *
     */
    public function display(User $user, Post $post)
    {
        //return false;
        return true;
    }
    /**
     * @param User $user
     * @param Role $item
     *
     * @return bool
     */
    public function edit(User $user, Post $post)
    {
        return true;
    }
    /**
     * @param User $user
     * @param Role $item
     *
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $user->isAdmin();;
    }
}
