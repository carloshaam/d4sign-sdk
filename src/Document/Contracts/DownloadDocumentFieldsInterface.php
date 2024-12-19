<?php

declare(strict_types=1);

namespace D4Sign\Document\Contracts;

interface DownloadDocumentFieldsInterface
{
    public function toArray(): array;
}
