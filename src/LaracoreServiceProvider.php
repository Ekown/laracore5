<?php

namespace Ekown\Laracore5;

use Illuminate\Support\ServiceProvider;
use Ekown\Laracore5\App\Audit\Flow\Form;
use Ekown\Laracore5\App\Audit\Logger;

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
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'laracore');

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
        $this->app->alias('logger', Logger::class);
        $this->app->alias('form', Form::class);

        $this->app->bind('logger', function(){

            $loggerConfig = config('laracore.audit');

            return new Logger(
                $loggerConfig['path'],
                $loggerConfig['minimum_level'],
                $loggerConfig['handler']
            );
        });

        $this->app->bind('form', function(){
            return new Form(
                resolve('logger')
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'logger',
            'form'
        ];
    }
}