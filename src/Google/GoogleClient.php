<?php declare(strict_types=1);

namespace Chiiya\LaravelPasses\Google;

use Chiiya\Passes\Google\Http\ClientInterface;
use Chiiya\Passes\Google\Http\GoogleAuthMiddleware;
use Chiiya\Passes\Google\ServiceCredentials;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use JsonSerializable;

class GoogleClient implements ClientInterface
{
    public function get(string $url): array
    {
        return $this->getClient()->get($url)->json();
    }

    public function post(string $url, JsonSerializable $data): array
    {
        return $this->getClient()->post($url, $data->jsonSerialize())->json();
    }

    public function put(string $url, JsonSerializable $data): array
    {
        return $this->getClient()->put($url, $data->jsonSerialize())->json();
    }

    /**
     * Get the configured base client.
     */
    protected function getClient(): PendingRequest
    {
        $client = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-type' => 'application/json',
        ]);

        if (! Http::isFaking()) {
            $credentials = ServiceCredentials::parse(config('passes.google.credentials'));
            $client->withMiddleware(GoogleAuthMiddleware::createAuthTokenMiddleware($credentials));
            $client->withOptions([
                'auth' => 'google_auth',
            ]);
        }

        return $client;
    }
}
