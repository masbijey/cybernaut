<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // start of work order gate auth

        // user can read.
        Gate::define('workorder-1234', function ($user) {
            return in_array($user->role->workorder, ['1', '2', '3', '4']);
        });
        // user can create.
        Gate::define('workorder-234', function ($user) {
            return in_array($user->role->workorder, ['2', '3', '4']);
        });

        // user can read, create, and approve.
        Gate::define('workorder-34', function ($user) {
            return in_array($user->role->workorder, ['3', '4']);
        });

        // user can read, create, approve, and delete.
        Gate::define('workorder-4', function ($user) {
            return in_array($user->role->workorder, ['4']);
        });

        // end of work order gate auth


    }
}
