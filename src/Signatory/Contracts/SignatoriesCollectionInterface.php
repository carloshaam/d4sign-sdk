<?php

declare(strict_types=1);

namespace D4Sign\Signatory\Contracts;

interface SignatoriesCollectionInterface
{
    public function addSigner(CreateSignatoryFieldsInterface $signer): void;

    public function getAll(): array;

    public function toArray(): array;
}
