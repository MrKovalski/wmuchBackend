<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(30));

        Gate::define('adminAccess', function($user) {
            return $user->role_id == 1;
        });

        Gate::define('userAccess', function($user) {
            return $user->role_id == 2;
        });

        Passport::tokensCan([
            'admin' => 'Manage admin and users',
            'user' => 'Post and manage user stuff',
        ]);

        Passport::setDefaultScope([
            'user',
            'admin'
        ]);
    }
}
