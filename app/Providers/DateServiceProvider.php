<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class DateServiceProvider extends ServiceProvider
{
    /**
     * Boot services.
     * Configure Laravel to use CarbonImmutable for dates.
     */
    public function boot()
    {
        Date::use(CarbonImmutable::class);
    }
}
