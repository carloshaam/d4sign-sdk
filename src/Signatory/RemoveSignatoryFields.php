<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\RemoveSignatoryFieldsInterface;

class RemoveSignatoryFields implements RemoveSignatoryFieldsInterface
{
    private string $emailSigner;
    private string $keySigner;

    public function __construct(string $emailSigner, string $keySigner)
    {
        if (! filter_var($emailSigner, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O e-mail do signatário '$emailSigner' não é válido.");
        }

        $this->emailSigner = $emailSigner;
        $this->keySigner = $keySigner;
    }

    public function toArray(): array
    {
        return [
            'email-signer' => $this->emailSigner,
            'key-signer' => $this->keySigner,
        ];
    }
}
