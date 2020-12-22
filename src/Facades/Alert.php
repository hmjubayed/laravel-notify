<?php

namespace Jubayed\Notify\Facades;

use Illuminate\Support\Facades\Facade;

class Alert extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'alert';
    }
}
