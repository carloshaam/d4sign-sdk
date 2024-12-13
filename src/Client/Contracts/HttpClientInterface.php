<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

use D4Sign\Response;

interface HttpClientInterface
{
    public function get(string $uri, array $options = []): Response;

    public function post(string $uri, array $options = []): Response;

    public function put(string $uri, array $options = []): Response;

    public function delete(string $uri, array $options = []): Response;

    public function options(string $uri, array $options = []): Response;
}
