<?php

namespace Ekown\Laracore5\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'form';
    }
}