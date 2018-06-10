<?php

namespace Audit\Flow\Login;

use Illuminate\Support\ServiceProvider;
use Audit\Logger;
use Audit\Flow\Login\Form;

class FlowServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('FormLogger', Form::class);
    }
}