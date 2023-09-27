<?php

namespace Adedaramola\Monnify\Providers;

use Adedaramola\Monnify\Contracts\ClientContract;
use Adedaramola\Monnify\Http\MonnifyClient;
use Illuminate\Support\ServiceProvider;

class MonnifyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__ . '/../../config/services.php',
            key: 'services',
        );
    }

    public function register(): void
    {
        $this->app->singleton(
            abstract: ClientContract::class,
            concrete: fn (): ClientContract => new MonnifyClient(
                url: strval(config('services.monnify.url')),
                apiKey: strval(config('services.monnify.api_key')),
                secretKey: strval(config('services.monnify.secret')),
                contractCode: strval(config('services.monnify.contact_code')),
            ),
        );
    }
}
