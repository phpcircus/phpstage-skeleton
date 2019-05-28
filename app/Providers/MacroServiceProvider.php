<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\CarbonImmutable as Carbon;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->registerRequestMacros();
        $this->registerCarbonMacros();
        $this->registerCollectionMacros();
    }

    /**
     * Register Request macros.
     */
    private function registerRequestMacros()
    {
        Request::mixin(new \App\Macros\Request);
    }

    /**
     * Register Carbon macros.
     */
    private function registerCarbonMacros()
    {
        Carbon::mixin(new \App\Macros\Carbon);
    }

    /**
     * Register Collection macros.
     */
    private function registerCollectionMacros()
    {
        Collection::mixin(new \App\Macros\Collection);
    }
}
