<?php

namespace App\Providers;


use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    //protected $widgets = [
    //    \Admin\Widgets\DashboardMap::class,
     //   \Admin\Widgets\NavigationUserBlock::class
   // ];
    /**
     * @var array
     */
    protected $sections = [
        'App\User' => 'App\Http\Admin\User',
        'App\Order' => 'App\Http\Admin\Order',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(Admin $admin)
    {
    	//

        parent::boot($admin);

    }

}
