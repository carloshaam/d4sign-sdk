<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\UpdateSignatoryEmailFieldsInterface;

class UpdateSignatoryEmailFields implements UpdateSignatoryEmailFieldsInterface
{
    private string $emailBefore;
    private string $emailAfter;
    private string $keySigner;

    public function __construct(string $emailBefore, string $emailAfter, string $keySigner)
    {
        if (! filter_var($emailBefore, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O antigo e-mail '$emailBefore' não é válido.");
        }

        if (! filter_var($emailAfter, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O novo e-mail '$emailAfter' não é válido.");
        }

        $this->emailBefore = $emailBefore;
        $this->emailAfter = $emailAfter;
        $this->keySigner = $keySigner;
    }

    public function toArray(): array
    {
        return [
            'email-before' => $this->emailBefore,
            'email-after' => $this->emailAfter,
            'key-signer' => $this->keySigner,
        ];
    }
}
