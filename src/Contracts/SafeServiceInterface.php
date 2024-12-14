<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface SafeServiceInterface
{
    public function findAll(): HttpResponseInterface;

    public function findAllDocumentByIdSafe(string $safeId, int $page = 1): HttpResponseInterface;

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1): HttpResponseInterface;

    public function findFolderById(string $safeId): HttpResponseInterface;

    public function createFolderById(string $safeId, array $fields): HttpResponseInterface;

    public function updateFolderById(string $safeId, array $fields): HttpResponseInterface;

    public function createBatch(array $fields): HttpResponseInterface;

    public function getBalance(): HttpResponseInterface;
}
