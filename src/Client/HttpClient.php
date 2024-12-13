<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class HttpClient implements HttpClientInterface
{
    private Client $http;

    public function __construct(Client $http = null)
    {
        $this->http = $http ?? new Client();
    }

    private function createResponse($rawResponse): Response
    {
        return new Response(
            $rawResponse->getStatusCode(),
            $rawResponse->getBody()->getContents(),
            $rawResponse->getHeaders(),
        );
    }

    public function get(string $url, array $query = [], array $headers = []): Response
    {
        $response = $this->http->get($url, array_merge($query, ['headers' => $headers]));

        return $this->createResponse($response);
    }

    public function post(string $url, array $body = [], array $headers = []): Response
    {
        $response = $this->http->post($url, [
            'headers' => $headers,
            'json' => $body,
        ]);

        return $this->createResponse($response);
    }

    public function put(string $url, array $body = [], array $headers = []): Response
    {
        $response = $this->http->put($url, [
            'headers' => $headers,
            'json' => $body,
        ]);

        return $this->createResponse($response);
    }

    public function delete(string $url, array $headers = []): Response
    {
        $response = $this->http->delete($url, ['headers' => $headers]);

        return $this->createResponse($response);
    }

    public function getAsync(string $url, array $query = [], array $headers = []): PromiseInterface
    {
        return $this->http
            ->getAsync($url, array_merge($query, ['headers' => $headers]))
            ->then(fn($rawResponse) => $this->createResponse($rawResponse))
            ->wait();
    }

    public function putAsync(string $url, array $body = [], array $headers = []): PromiseInterface
    {
        return $this->http
            ->putAsync($url, array_merge($body, ['headers' => $headers]))
            ->then(fn($rawResponse) => $this->createResponse($rawResponse))
            ->wait();
    }

    public function deleteAsync(string $url, array $headers = []): PromiseInterface
    {
        return $this->http
            ->deleteAsync($url, ['headers' => $headers])
            ->then(fn($rawResponse) => $this->createResponse($rawResponse))
            ->wait();
    }
}
