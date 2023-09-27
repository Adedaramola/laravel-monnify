<?php

declare(strict_types=1);

namespace Adedaramola\Monnify\Http;

use Adedaramola\Monnify\Contracts\ClientContract;
use Adedaramola\Monnify\Enums\Method;
use Adedaramola\Monnify\Exceptions\MonnifyApiException;
use Adedaramola\Monnify\Http\Resources\VerificationResource;
use Closure;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
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

    public function send(Method $method, string $uri, array $options = []): Response
    {
        $response = $this->newRequest()
            ->withToken($this->getAccessToken())
            ->send($method->value, $uri, $options);

        if ($response->failed()) {
            throw new MonnifyApiException(
                response: $response
            );
        }

        return $response;
    }

    protected function newRequest(): PendingRequest
    {
        return Http::baseUrl($this->url)
            ->timeout(15)
            ->withUserAgent('Adedaramola/laravel-monnify')
            ->asJson()
            ->acceptJson();
    }

    protected function getAccessToken(): string
    {
        $tokenCacheKey = strval(config('services.monnify.token_cache_key'));
        
        return Cache::remember($tokenCacheKey, 3500, function (): string {
            $response = $this->newRequest()->withBasicAuth(
                username: $this->apiKey,
                password: $this->secretKey,
            )->send(
                method: Method::GET->value,
                url: '/api/v1/auth/login',
            );

            if ($response->failed()) {
                throw new MonnifyApiException(
                    response: $response
                );
            }

            $accessToken = $response->json('responseBody.accessToken');

            return (string) $accessToken;
        });
    }

    public static function fake(Closure|array $callback): Factory
    {
        return Http::fake($callback);
    }
}
