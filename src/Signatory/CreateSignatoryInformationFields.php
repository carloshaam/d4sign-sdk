<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use D4Sign\Signatory\Contracts\CreateSignatoryInformationFieldsInterface;

class CreateSignatoryInformationFields implements CreateSignatoryInformationFieldsInterface
{
    private string $keySigner;
    private string $email;
    private ?string $displayName = null;
    private ?string $documentation = null;
    private ?string $birthday = null;
    private ?string $tokenAPI = null;

    public function __construct(string $keySigner, string $email)
    {
        $this->setKeySigner($keySigner);
        $this->setEmail($email);
    }

    public function setKeySigner(string $keySigner): self
    {
        $this->keySigner = $keySigner;

        return $this;
    }

    public function setEmail(string $email): self
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new D4SignInvalidArgumentException("O e-mail do signatário '$email' não é válido.");
        }

        $this->email = $email;

        return $this;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function setDocumentation(?string $documentation): self
    {
        $this->documentation = $documentation;

        return $this;
    }

    public function setBirthday(?string $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function setTokenAPI(?string $tokenAPI): self
    {
        $this->tokenAPI = $tokenAPI;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'key-signer' => $this->keySigner,
            'email' => $this->email,
            'display_name' => $this->displayName,
            'documentation' => $this->documentation,
            'birthday' => $this->birthday,
            'tokenAPI' => $this->tokenAPI,
        ];
    }
}
