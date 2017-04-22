<?php

namespace App\Providers;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    protected $widgets = [
        \App\Admin\Widgets\DashboardInfo::class,
        \App\Admin\Widgets\NavigationUserBlock::class
    ];

    /**
     * @var array
     */
    protected $sections = [
        'App\User' => 'App\Admin\User',
        'App\Order' => 'App\Admin\Order',
        'App\UserProfile' => 'App\Admin\Client',
        'App\AdminUser' => 'App\Admin\AdminUser',
        'App\Banner' => 'App\Admin\Banner',
        'App\Menu' => 'App\Admin\Menu',
        'App\News' => 'App\Admin\News',
        'App\Page' => 'App\Admin\Page',
        'App\Settings' => 'App\Admin\Settings',
        'App\Slider' => 'App\Admin\Slider',
        'App\Stock' => 'App\Admin\Stock',
        'App\Status' => 'App\Admin\Status',
        'App\StatusRepair' => 'App\Admin\StatusRepair',
    ];
    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
        $this->registerPolicies('App\\Admin\\Policies\\');
        parent::boot($admin);
        $this->app->call([$this, 'registerViews']);

    }

    public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
    {
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
    }




}
