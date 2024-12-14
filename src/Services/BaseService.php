<?php

declare(strict_types=1);

namespace D4Sign\Services;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Client\HttpClient;
use D4Sign\Response;

abstract class BaseService
{
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    protected function get(string $uri, array $options = []): Response
    {
        $response = $this->client->withQuery($options['query'] ?? [])->get($uri);

        return new Response($response->status(), $response->body(), $response->headers());
    }

    protected function post(string $uri, array $options = []): Response
    {
        $response = $this->client;

        // Verifique o tipo de dados no corpo: JSON, multipart, etc.
        if (isset($options['json'])) {
            $response = $response->withJson($options['json']);
        } elseif (isset($options['multipart'])) {
            $response = $response->withMultipart($options['multipart']);
        } elseif (isset($options['body'])) {
            $response = $response->withBody($options['body']);
        }

        $response = $response->post($uri);

        return new Response($response->status(), $response->body(), $response->headers());
    }

    protected function put(string $uri, array $options = []): Response
    {
        $response = $this->client->withJson($options['json'] ?? [])->put($uri);

        return new Response($response->status(), $response->body(), $response->headers());
    }

    protected function delete(string $uri, array $options = []): Response
    {
        $response = $this->client->withJson($options['json'] ?? [])->delete($uri);

        return new Response($response->status(), $response->body(), $response->headers());
    }
}
