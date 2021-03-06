<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DuskServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        if ($this->app->runningUnitTests()) {
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }
    }
}
