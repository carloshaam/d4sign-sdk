<?php

declare(strict_types=1);

namespace D4Sign;

use D4Sign\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    protected int $statusCode;
    protected $content;
    protected $headers;

    public function __construct(int $statusCode, $content, $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
    }

    public function getContent()
    {
        return json_decode($this->content, true);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function isSuccess(): bool
    {
        return $this->getStatusCode() >= 200 && $this->getStatusCode() < 300;
    }

    public function isOk(): bool
    {
        return $this->isSuccess();
    }

    public function isRedirect(): bool
    {
        return $this->getStatusCode() >= 300 && $this->getStatusCode() < 400;
    }

    public function isClientError(): bool
    {
        return $this->getStatusCode() >= 400 && $this->getStatusCode() < 500;
    }

    public function isServerError(): bool
    {
        return $this->getStatusCode() >= 500;
    }

    public function __toString(): string
    {
        return '[Response] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }
}
