<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\SafeServiceInterface;

class SafeService implements SafeServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function findAll(): HttpResponse
    {
        return $this->httpClient->get('safes');
    }

    public function findAllDocumentByIdSafe(string $safeId, int $page = 1): HttpResponse
    {
        return $this->httpClient->get("documents/{$safeId}/safe", ['pg' => $page]);
    }

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1): HttpResponse
    {
        return $this->httpClient->get("documents/{$safeId}/safe/{$folderId}", ['pg' => $page]);
    }

    public function findFolderById(string $safeId): HttpResponse
    {
        return $this->httpClient->get("folders/{$safeId}/find");
    }

    public function createFolderById(string $safeId, array $fields): HttpResponse
    {
        return $this->httpClient->post("folders/{$safeId}/create", $fields);
    }

    public function updateFolderById(string $safeId, array $fields): HttpResponse
    {
        return $this->httpClient->post("folders/{$safeId}/rename", $fields);
    }

    public function createBatch(array $fields): HttpResponse
    {
        return $this->httpClient->post('batches', $fields);
    }

    public function getBalance(): HttpResponse
    {
        return $this->httpClient->get('account/balance');
    }
}
