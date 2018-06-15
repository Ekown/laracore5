<?php

namespace Ekown\Laracore5\Facades\Login;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'login.form';
    }
}