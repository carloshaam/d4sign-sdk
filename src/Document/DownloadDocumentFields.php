<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Document\Contracts\DownloadDocumentFieldsInterface;

class DownloadDocumentFields implements DownloadDocumentFieldsInterface
{
    private ?string $type;
    private ?string $language;
    private ?bool $document = false;

    public function __construct() {}

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setDocument(?bool $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        if ($this->language !== null) {
            $data['language'] = $this->language;
        }

        if ($this->document !== null) {
            $data['document'] = $this->document;
        }

        return $data;
    }
}
