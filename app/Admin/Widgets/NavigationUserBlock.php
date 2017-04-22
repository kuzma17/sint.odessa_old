<?php
namespace App\Admin\Widgets;
use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;
class NavigationUserBlock extends Widget
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        $user = auth()->user();
        $avatar = 'images/avatars/no_avatar.png';
        if($user->avatar && $user->avatar->avatar != '') {
            $avatar = $user->avatar->avatar;
        }
        return view('admin.navbar', ['user' => $user, 'avatar' => $avatar])->render();
    }
    /**
     * @return string|array
     */
    public function template()
    {
        return AdminTemplate::getViewPath('_partials.header');
    }
    /**
     * @return string
     */
    public function block()
    {
        return 'navbar.right';
    }
}