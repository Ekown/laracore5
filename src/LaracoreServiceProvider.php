<?php

namespace Ekown\Laracore5;

use Illuminate\Support\ServiceProvider;

class LaracoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/path/to/config/laracore.php' => config_path('laracore.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/path/to/config/laracore.php', 'laracore'
        );
    }
}