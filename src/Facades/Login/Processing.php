<?php

namespace Ekown\Laracore5\Facades\Login;

use Illuminate\Support\Facades\Facade;

class Processing extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'login.processing';
    }
}