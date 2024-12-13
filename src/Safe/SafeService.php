<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Contracts\SafeServiceInterface;
use D4Sign\Response;
use D4Sign\Services\BaseService;

class SafeService extends BaseService implements SafeServiceInterface
{
    public function findAll(): Response
    {
        return $this->get('safes');
    }

    public function findAllDocumentByIdSafe(string $safeId, int $page = 1): Response
    {
        return $this->get("documents/{$safeId}/safe", ['query' => ['pg' => $page]]);
    }

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1): Response
    {
        return $this->get("documents/{$safeId}/safe/{$folderId}", ['query' => ['pg' => $page]]);
    }

    public function findFolderById(string $safeId): Response
    {
        return $this->get("folders/{$safeId}/find");
    }

    public function createFolderById(string $safeId, array $fields): Response
    {
        return $this->post("folders/{$safeId}/create", [
            'json' => $fields,
        ]);
    }

    public function updateFolderById(string $safeId, array $fields): Response
    {
        return $this->post("folders/{$safeId}/rename", [
            'json' => $fields,
        ]);
    }

    public function createBatche(array $fields): Response
    {
        return $this->post('batches', [
            'json' => $fields,
        ]);
    }

    public function getBalance(): Response
    {
        return $this->get('account/balance');
    }
}
