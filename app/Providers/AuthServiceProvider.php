<?php

namespace App\Providers;

use App\Models\User;
use ReflectionClass;
use App\Authorization\Policies;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $policies = [];

    /** @var array */
    protected $policyNames = [];

    public const ADMINISTER_USERS = 'administerUsers';
    public const LIST_USERS = 'listUsers';
    public const UPDATE_USER = 'updateUser';
    public const VIEW_USER = 'viewUser';

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this::enactPolicies();
    }

    /**
     * Check if the currently authenticated user is an administrator.
     *
     * @param  \App\Models\User  $authenticated
     */
    public static function checkAdmins(User $authenticated): bool
    {
        return in_array($authenticated->email, [
            Config::get('auth.admin.email'),
        ]);
    }

    /**
     * Enact all policies.
     */
    private function enactPolicies(): void
    {
        $this->app->singleton(Policies::class, function ($app) {
            return new Policies;
        });

        $reflectionClass = new ReflectionClass(static::class);
        resolve(Policies::class)->setPolicies($reflectionClass->getConstants());

        $this->enactUserPolicies();
    }

    /**
     * Get the policy names.
     */
    public function getPolicyNames(): array
    {
        return resolve(Policies::class)->getPolicies();
    }

    /**
     * Enact the policies for users.
     */
    private static function enactUserPolicies(): void
    {
        Gate::define(static::ADMINISTER_USERS, static function (User $authenticated) {
            return $authenticated->is_super_admin;
        });

        Gate::define(static::LIST_USERS, static function (User $authenticated) {
            return $authenticated->is_admin;
        });

        Gate::define(static::UPDATE_USER, static function (User $authenticated, User $user) {
            return $authenticated->id === $user->id || static::checkAdmins($authenticated);
        });

        Gate::define(static::VIEW_USER, static function (User $authenticated, User $user) {
            return $authenticated;
        });
    }
}
