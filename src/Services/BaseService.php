<?php

declare(strict_types=1);

namespace D4Sign\Services;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Response;

abstract class BaseService
{
    protected HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    protected function get(string $uri, array $options = []): Response
    {
        return $this->client->get($uri, $options);
    }

    protected function post(string $uri, array $options = []): Response
    {
        return $this->client->post($uri, $options);
    }

    protected function put(string $uri, array $options = []): Response
    {
        return $this->client->put($uri, $options);
    }

    protected function delete(string $uri, array $options = []): Response
    {
        return $this->client->delete($uri, $options);
    }

    protected function options($uri, $options = [])
    {
        return $this->client->options($uri, $options);
    }
}
