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
        $this->shareVersion();
        $this->shareAuthenticatedUser();
        $this->shareAppData();
        $this->shareFlashMessages();
        $this->shareErrors();
    }

    /**
     * Share asset version.
     */
    private function shareVersion(): void
    {
        Inertia::version(static function () {
            return md5_file(public_path('mix-manifest.json'));
        });
    }

    /**
     * Share the authenticated user.
     */
    private function shareAuthenticatedUser(): void
    {
        Inertia::share([
            'auth' => function () {
                $user = Auth::user();

                return [
                    'user' => $user ? [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_admin' => $user->is_admin,
                        'deleted_at' => $user->deleted_at,
                        'can' => $user->getAuthorizationDetails(),
                    ] : null,
                ];
            },
        ]);
    }

    /**
     * Share app data.
     */
    private function shareAppData(): void
    {
        Inertia::share([
            'app' => static function () {
                return [
                    'name' => Config::get('app.name'),
                ];
            },
        ]);
    }

    private function shareFlashMessages(): void
    {
        Inertia::share([
            'success' => static function () {
                $success = Session::get('flash_message')['success'] ?? null;

                return [
                    'message' => $success ? $success['message'] : null,
                    'class' => $success ? $success['class'] : null,
                ];
            },
            'warning' => static function () {
                $warning = Session::get('flash_message')['warning'] ?? null;

                return [
                    'message' => $warning ? $warning['message'] : null,
                    'class' => $warning ? $warning['class'] : null,
                ];
            },
            'info' => static function () {
                $info = Session::get('flash_message')['info'] ?? null;

                return [
                    'message' => $info ? $info['message'] : null,
                    'class' => $info ? $info['class'] : null,
                ];
            },
        ]);
    }

    /**
     * Share errors.
     */
    private function shareErrors(): void
    {
        Inertia::share([
            'errors' => function () {
                if ($errors = Session::get('errors')) {
                    $bags = $errors->getBags();

                    return collect($bags)->map(function ($bag, $key) {
                        return $bag->getMessages();
                    });
                }

                return (object) [];
            },
        ]);
    }
}
