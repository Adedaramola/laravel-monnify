<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Facades;

use Adedaramola\Monnify\Contracts\ClientContract;
use Illuminate\Support\Facades\Facade;

class Monnify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClientContract::class;
    }
}
