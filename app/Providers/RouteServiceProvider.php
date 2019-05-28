<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $controllerNamespace = 'App\Http\Controllers';

    /**
     * This namespace is applied to your action routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $actionNamespace = 'App\Http\Actions';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapControllerRoutes();

        $this->mapActionRoutes();
    }

    /**
     * Define the "controller" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapControllerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->controllerNamespace)
            ->group(base_path('routes/controllers.php'));
    }

    /**
     * Define the "action" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapActionRoutes()
    {
        Route::middleware('web')
            ->namespace($this->actionNamespace)
            ->group(base_path('routes/actions.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
