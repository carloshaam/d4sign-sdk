<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Signatory\Contracts\CreateSignatoryFieldsInterface;
use D4Sign\Signatory\Contracts\SignatoriesCollectionInterface;

class SignatoriesCollection implements SignatoriesCollectionInterface
{
    /** @var CreateSignatoryFieldsInterface[] */
    private array $signers = [];

    public function addSigner(CreateSignatoryFieldsInterface $signer): void
    {
        $this->signers[] = $signer;
    }

    public function getAll(): array
    {
        return $this->signers;
    }

    public function toArray(): array
    {
        return array_map(fn(CreateSignatoryFieldsInterface $signer) => $signer->toArray(), $this->signers);
    }
}
