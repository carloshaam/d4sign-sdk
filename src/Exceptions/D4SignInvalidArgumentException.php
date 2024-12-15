<?php

declare(strict_types=1);

namespace D4Sign\Exceptions;

class D4SignInvalidArgumentException extends \LogicException
{
    protected string $methodName;
    protected array $additionalInfo;

    public function __construct(string $message, int $code = 0, \Exception $previous = null)
    {
        $this->methodName = $this->getCallingMethodName();

        $this->additionalInfo = [
            'method' => $this->methodName,
        ];

        $message = "D4SignApi Error in method {$this->methodName}: $message";

        parent::__construct($message, $code, $previous);
    }

    private function getCallingMethodName(): string
    {
        $trace = debug_backtrace();

        return $trace[2]['function'] ?? 'unknown';
    }

    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }
}
