<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->shareWithInertia();
    }

    /**
     * Configure and share data with Inertia.
     */
    protected function shareWithInertia()
    {
        Inertia::version(static function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share('app.name', Config::get('app.name'));

        Inertia::share('errors', static function () {
            return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) [];
        });

        Inertia::share('success', static function () {
            return [
                'success' => Session::get('success'),
            ];
        });

        Inertia::share('warning', static function () {
            return [
                'warning' => Session::get('warning'),
            ];
        });

        Inertia::share('info', static function () {
            return [
                'info' => Session::get('info'),
            ];
        });

        Inertia::share('auth.user', static function () {
            if ($user = Auth::user()) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_admin' => $user->is_admin,
                ];
            }
        });
    }
}
