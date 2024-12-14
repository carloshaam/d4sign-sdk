<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient implements HttpClientInterface
{
    private Client $client;
    private array $options = [];

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * Static instance for quick use (Fluent Syntax).
     */
    public static function new(array $config = []): self
    {
        return new self($config);
    }

    /**
     * Set a base URI for the client.
     */
    public function baseUrl(string $url): self
    {
        $this->options['base_uri'] = rtrim($url, '/') . '/';

        return $this;
    }

    /**
     * Add default headers to the request.
     */
    public function withHeaders(array $headers): self
    {
        $this->options['headers'] = $headers;

        return $this;
    }

    /**
     * Set query parameters.
     */
    public function withQuery(array $query): self
    {
        $this->options['query'] = $query;

        return $this;
    }

    /**
     * Set JSON body content.
     */
    public function withJson(array $json): self
    {
        $this->options['json'] = $json;

        return $this;
    }

    /**
     * Set multipart form data.
     */
    public function withMultipart(array $multipart): self
    {
        $this->options['multipart'] = $multipart;

        return $this;
    }

    /**
     * Set raw body content.
     */
    public function withBody(string $body): self
    {
        $this->options['body'] = $body;

        return $this;
    }

    /**
     * Make a GET request.
     */
    public function get(string $uri): HttpResponse
    {
        return $this->send('GET', $uri);
    }

    /**
     * Make a POST request.
     */
    public function post(string $uri): HttpResponse
    {
        return $this->send('POST', $uri);
    }

    /**
     * Make a PUT request.
     */
    public function put(string $uri): HttpResponse
    {
        return $this->send('PUT', $uri);
    }

    /**
     * Make a DELETE request.
     */
    public function delete(string $uri): HttpResponse
    {
        return $this->send('DELETE', $uri);
    }

    /**
     * Send the request using GuzzleHttp.
     */
    public function send(string $method, string $uri): HttpResponse
    {
        try {
            $response = $this->client->request($method, $uri, $this->options);

            return new HttpResponse(
                $response->getStatusCode(),
                (string)$response->getBody(),
                $response->getHeaders(),
            );
        } catch (GuzzleException $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
