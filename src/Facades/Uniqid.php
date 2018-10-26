<?php

namespace Jervenclark\Uniqid\Facades;

use Illuminate\Support\Facades\Facade;

class Uniqid extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uniqid';
    }
}
