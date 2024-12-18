<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\UpdateSignatorySmsNumberFieldsInterface;

class UpdateSignatorySmsNumberFields implements UpdateSignatorySmsNumberFieldsInterface
{
    private string $email;
    private string $smsNumber;
    private string $keySigner;

    public function __construct(string $email, string $smsNumber, string $keySigner)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O e-mail do signatário '$email' não é válido.");
        }

        if (! preg_match('/^\+\d{11,15}$/', $smsNumber)) {
            throw new D4SignInvalidArgumentException(
                "Número inválido: '$smsNumber'. Deve estar no formato internacional, incluindo o código do país.",
            );
        }

        $this->email = $email;
        $this->smsNumber = $smsNumber;
        $this->keySigner = $keySigner;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'sms-number' => $this->smsNumber,
            'key-signer' => $this->keySigner,
        ];
    }
}
