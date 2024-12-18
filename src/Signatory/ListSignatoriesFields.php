<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Signatory\Contracts\ListSignatoriesFieldsInterface;

class ListSignatoriesFields implements ListSignatoriesFieldsInterface
{
    private SignatoriesCollection $signers;

    public function __construct(SignatoriesCollection $signers)
    {
        $this->signers = $signers;
    }

    public function toArray(): array
    {
        return ['signers' => $this->signers->toArray()];
    }
}
