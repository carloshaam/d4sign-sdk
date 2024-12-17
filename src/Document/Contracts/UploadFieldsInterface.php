<?php

declare(strict_types=1);

namespace D4Sign\Document\Contracts;

interface UploadFieldsInterface
{
    /**
     * Converte os dados para uma estrutura compatível com a API.
     *
     * @return array Estrutura formatada.
     */
    public function toArray(): array;
}
