<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\User::class => \App\Policies\UserSectionModelPolicy::class,
        \App\Role::class => \App\Policies\RolePolicy::class,
        \App\Post::class => \App\Policies\PostPolicy::class
        ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
