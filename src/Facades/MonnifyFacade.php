<?php

namespace Adedaramola\Monnify\Facades;

use Illuminate\Support\Facades\Facade;

class MonnifyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-monnify';
    }
}
