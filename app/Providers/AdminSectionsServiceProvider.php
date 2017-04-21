<?php

namespace App\Providers;


use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    protected $widgets = [
    //    \App\Admin\Widgets\DashboardMap::class,
        \App\Admin\Widgets\NavigationUserBlock::class
    ];

    /**
     * @var array
     */
    protected $sections = [
        'App\User' => 'App\Http\Admin\User',
        'App\Order' => 'App\Http\Admin\Order',
        'App\UserProfile' => 'App\Http\Admin\UserProfile',
        'App\AdminUser' => 'App\Http\Admin\AdminUser',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
        $this->registerPolicies('App\\Policies\\');
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
