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
        // Sets the path of the package's config files
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'contact');

        // Sets the path of the package's publish files
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('laracore.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }
}