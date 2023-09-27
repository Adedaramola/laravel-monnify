<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Http\Resources;

use Adedaramola\Monnify\Contracts\ClientContract;
use Adedaramola\Monnify\Contracts\ResourceContract;

abstract class MonnifyResource implements ResourceContract
{
    public function __construct(
        protected readonly ClientContract $client,
    ) {}
}