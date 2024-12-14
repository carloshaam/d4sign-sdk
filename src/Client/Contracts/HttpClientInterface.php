<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

interface HttpClientInterface
{
    public static function new(array $config = []): self;

    public function baseUrl(string $url): self;

    public function withHeaders(array $headers): self;

    public function withQuery(array $query): self;

    public function withJson(array $json): self;

    public function withMultipart(array $multipart): self;

    public function withBody(string $body): self;

    public function get(string $uri): HttpResponseInterface;

    public function post(string $uri): HttpResponseInterface;

    public function put(string $uri): HttpResponseInterface;

    public function delete(string $uri): HttpResponseInterface;
}
