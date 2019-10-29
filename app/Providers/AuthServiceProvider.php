<?php

namespace App\Providers;

use App\Entity\Product\Product;
use App\Entity\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        $this->registerPermissions();
    }

    public function registerPermissions()
    {
        Gate::define('manage-products-categories', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });Gate::define('admin-panel', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
        Gate::define('manage-products', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
        Gate::define('manage-products', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

    }
}
