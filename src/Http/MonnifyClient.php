<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Http;

use Adedaramola\Monnify\Contracts\ClientContract;
use Adedaramola\Monnify\Http\Resources\VerificationResource;
use Closure;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

class MonnifyClient implements ClientContract
{
    public function __construct(
        protected readonly string $url,
        protected readonly string $apiKey,
        protected readonly string $secretKey,
        protected readonly string $contractCode,
    ) {}

    public function verification(): VerificationResource
    {
        return new VerificationResource($this);
    }

    public static function fake(Closure|array $callback): Factory
    {
        return Http::fake($callback);
    }
}
