<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Contracts;

use Adedaramola\Monnify\Enums\Method;
use Adedaramola\Monnify\Http\Resources\VerificationResource;
use Illuminate\Http\Client\Response;

interface ClientContract
{
    public function verification(): VerificationResource;
    
    public function send(Method $method, string $uri, array $options = []): Response;
}