<?php

declare(strict_types=1);

namespace D4Sign\Client;

use D4Sign\Client\Contracts\HttpResponseInterface;

class HttpResponse implements HttpResponseInterface
{
    private int $status;
    private string $body;
    private array $headers;

    public function __construct(int $status, string $body, array $headers)
    {
        $this->status = $status;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function json(): array
    {
        try {
            return json_decode($this->body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \RuntimeException('Invalid JSON body: ' . $e->getMessage());
        }
    }

    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Retrieve a specific header by name in a case-insensitive way.
     */
    public function getHeader(string $name): ?string
    {
        $key = strtolower($name);
        foreach ($this->headers as $headerName => $headerValue) {
            if (strtolower($headerName) === $key) {
                return is_array($headerValue) ? implode(', ', $headerValue) : $headerValue;
            }
        }

        return null;
    }

    /**
     * Check if the response has a specific header.
     */
    public function hasHeader(string $name): bool
    {
        $key = strtolower($name);
        foreach ($this->headers as $headerName => $headerValue) {
            if (strtolower($headerName) === $key) {
                return true;
            }
        }

        return false;
    }

    public function isSuccess(): bool
    {
        return $this->status >= 200 && $this->status < 300;
    }

    public function isClientError(): bool
    {
        return $this->status >= 400 && $this->status < 500;
    }

    public function isServerError(): bool
    {
        return $this->status >= 500;
    }
}
