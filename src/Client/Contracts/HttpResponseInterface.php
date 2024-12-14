<?php

declare(strict_types=1);

namespace D4Sign\Client\Contracts;

interface HttpResponseInterface
{
    public function status(): int;

    public function body(): string;

    public function json(): array;

    public function headers(): array;

    public function getHeader(string $name): ?string;

    public function hasHeader(string $name): bool;

    public function isSuccess(): bool;

    public function isClientError(): bool;

    public function isServerError(): bool;
}
