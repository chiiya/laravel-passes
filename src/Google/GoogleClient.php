<?php declare(strict_types=1);

namespace Chiiya\LaravelPasses\Google;

use Chiiya\Passes\Google\Http\ClientInterface;
use Chiiya\Passes\Google\Http\GoogleAuthMiddleware;
use Chiiya\Passes\Google\ServiceCredentials;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use JsonSerializable;

class GoogleClient implements ClientInterface
{
    /**
     * Get a resource.
     *
     * @throws RequestException
     */
    public function get(string $url): array
    {
        return $this->evaluate($this->getClient()->get($url));
    }

    /**
     * Create a resource.
     *
     * @throws RequestException
     */
    public function post(string $url, JsonSerializable $data): array
    {
        return $this->evaluate($this->getClient()->post($url, $data->jsonSerialize()));
    }

    /**
     * Update a resource.
     *
     * @throws RequestException
     */
    public function put(string $url, JsonSerializable $data): array
    {
        return $this->evaluate($this->getClient()->put($url, $data->jsonSerialize()));
    }

    /**
     * Check for errors and return JSON decoded response.
     *
     * @throws RequestException
     */
    protected function evaluate(Response $response): array
    {
        $response->throw();

        return $response->json();
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
