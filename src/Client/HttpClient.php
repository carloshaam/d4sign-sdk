<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Exceptions\D4SignHttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpClient implements HttpClientInterface
{
    private Client $client;

    private array $options;

    private string $bodyFormat;

    private array $defaultOptions;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
        $this->bodyFormat = 'json';
        $this->defaultOptions = [
            'base_uri' => $config['base_uri'] ?? null,
            'headers' => [
                'tokenAPI' => $config['headers']['tokenAPI'] ?? null,
                'cryptKey' => $config['headers']['cryptKey'] ?? null,
            ],
        ];
        $this->options = [
            'http_errors' => false,
        ];
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
        $this->defaultOptions['base_uri'] = rtrim($url, '/') . '/';

        return $this;
    }

    public function withOptions($options): self
    {
        $this->options = array_merge_recursive($this->options, $options);

        return $this;
    }

    public function withoutRedirecting(): self
    {
        $this->options = array_merge_recursive($this->options, [
            'allow_redirects' => false,
        ]);

        return $this;
    }

    public function withoutVerifying(): self
    {
        $this->options = array_merge_recursive($this->options, [
            'verify' => false,
        ]);

        return $this;
    }

    public function asJson(): self
    {
        $this->bodyFormat('json')->contentType('application/json');

        return $this;
    }

    public function asFormParams(): self
    {
        $this->bodyFormat('form_params')->contentType('application/x-www-form-urlencoded');

        return $this;
    }

    public function asMultipart(): self
    {
        $this->bodyFormat('multipart');

        return $this;
    }

    public function bodyFormat($format): self
    {
        $this->bodyFormat = $format;

        return $this;
    }

    public function contentType($contentType): self
    {
        $this->withHeaders(['Content-Type' => $contentType]);

        return $this;
    }

    public function accept($header): self
    {
        $this->withHeaders(['Accept' => $header]);

        return $this;
    }

    /**
     * Add default headers to the request.
     */
    public function withHeaders(array $headers): self
    {
        $this->defaultOptions['headers'] = array_merge(
            $this->defaultOptions['headers'],
            $headers,
        );

        return $this;
    }

    public function withBasicAuth(string $username, string $password): self
    {
        $this->options = array_merge_recursive($this->options, [
            'auth' => [$username, $password],
        ]);

        return $this;
    }

    public function withDigestAuth(string $username, string $password): self
    {
        $this->options = array_merge_recursive($this->options, [
            'auth' => [$username, $password, 'digest'],
        ]);

        return $this;
    }

    public function withCookies(string $cookies): self
    {
        $this->options = array_merge_recursive($this->options, [
            'cookies' => $cookies,
        ]);

        return $this;
    }

    public function timeout(int $seconds): self
    {
        $this->options['timeout'] = $seconds;

        return $this;
    }

    /**
     * Make a GET request.
     */
    public function get(string $uri, array $params = []): HttpResponse
    {
        return $this->send('GET', $uri, [
            'query' => $params,
        ]);
    }

    /**
     * Make a POST request.
     */
    public function post(string $uri, array $params = []): HttpResponse
    {
        return $this->send('POST', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * Make a PUT request.
     */
    public function put(string $uri, array $params = []): HttpResponse
    {
        return $this->send('PUT', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * Make a DELETE request.
     */
    public function delete(string $uri, array $params = []): HttpResponse
    {
        return $this->send('DELETE', $uri, [
            $this->bodyFormat => $params,
        ]);
    }

    /**
     * Send the request using GuzzleHttp.
     */
    public function send(string $method, string $uri, $options): HttpResponse
    {
        try {
            $query = parse_url($uri, PHP_URL_QUERY) ? $this->parseQueryParams($uri) : [];

            $response = $this->client->request(
                $method,
                $uri,
                $this->mergeOptions(['query' => $query], $options),
            );

            return new HttpResponse(
                $response->getStatusCode(),
                (string)$response->getBody(),
                $response->getHeaders(),
            );
        } catch (GuzzleException $e) {
            throw new D4SignHttpClientException($e->getMessage(), $e->getCode(), $e);
        } finally {
            $this->resetRequest();
        }
    }

    public function mergeOptions(...$options): array
    {
        return array_merge_recursive($this->defaultOptions, $this->options, ...$options);
    }

    public function parseQueryParams($url): array
    {
        $query = [];
        parse_str(parse_url($url, PHP_URL_QUERY), $query);

        return $query;
    }

    public function resetRequest(): void
    {
        $this->options = [
            'http_errors' => false,
        ];
        $this->bodyFormat = 'json';
    }
}
