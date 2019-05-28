<?php

namespace App\Providers;

use App\Models\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-user', function ($authenticated, $user) {
            return $authenticated->id === $user->id || $this->checkAdmins($authenticated);
        });
    }

    /**
     * Check if the currently authenticated user is an administrator.
     *
     * @param  \App\Models\User  $authenticated
     *
     * @return bool
     */
    public function checkAdmins(User $authenticated)
    {
        return in_array($authenticated->email, [
            'clay@phpstage.com',
        ]);
    }
}
