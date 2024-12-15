<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

interface HttpClientInterface
{
    public static function new(array $config = []): self;

    public function baseUrl(string $url): self;

    public function withOptions($options): self;

    public function withoutRedirecting(): self;

    public function withoutVerifying(): self;

    public function asJson(): self;

    public function asFormParams(): self;

    public function asMultipart(): self;

    public function bodyFormat($format): self;

    public function contentType($contentType): self;

    public function accept($header): self;

    public function withHeaders(array $headers): self;

    public function withBasicAuth(string $username, string $password): self;

    public function withDigestAuth(string $username, string $password): self;

    public function withCookies(string $cookies): self;

    public function timeout(int $seconds): self;

    public function get(string $uri): HttpResponseInterface;

    public function post(string $uri): HttpResponseInterface;

    public function put(string $uri): HttpResponseInterface;

    public function delete(string $uri): HttpResponseInterface;

    public function send(string $method, string $uri, $options): HttpResponseInterface;

    public function mergeOptions(...$options): array;

    public function parseQueryParams($url): array;

    public function resetRequest(): void;
}
