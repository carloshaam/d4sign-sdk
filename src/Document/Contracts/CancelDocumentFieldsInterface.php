<?php

declare(strict_types=1);

namespace D4Sign\Document\Contracts;

interface CancelDocumentFieldsInterface
{
    /**
     * Retorna os dados formatados para a API.
     *
     * @return array Dados no formato correto.
     */
    public function toArray(): array;
}
