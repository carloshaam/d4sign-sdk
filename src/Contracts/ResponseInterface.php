<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

/**
 * Interface defining the structure for a response object.
 */
interface ResponseInterface
{
    /**
     * Returns the response contents as a decoded array.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * Returns the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Returns the response headers.
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Determines if the operation was successful.
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Determines if the current state or condition is acceptable.
     *
     * @return bool
     */
    public function isOk(): bool;

    /**
     * Determines if the response indicates a redirection.
     *
     * @return bool
     */
    public function isRedirect(): bool;

    /**
     * Determines if the response status code indicates a client error (4xx).
     *
     * @return bool
     */
    public function isClientError(): bool;

    /**
     * Determines if the response indicates a server error.
     *
     * @return bool
     */
    public function isServerError(): bool;

    /**
     * Returns the string representation of the response.
     *
     * @return string
     */
    public function __toString(): string;
}
