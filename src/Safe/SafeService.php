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
        return $this->httpClient->withQuery(['pg' => $page])->get("documents/{$safeId}/safe");
    }

    public function findAllDocumentByIdSafeAndIdFolder(string $safeId, string $folderId, int $page = 1): HttpResponse
    {
        return $this->httpClient->withQuery(['pg' => $page])->get("documents/{$safeId}/safe/{$folderId}");
    }

    public function findFolderById(string $safeId): HttpResponse
    {
        return $this->httpClient->get("folders/{$safeId}/find");
    }

    public function createFolderById(string $safeId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("folders/{$safeId}/create");
    }

    public function updateFolderById(string $safeId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("folders/{$safeId}/rename");
    }

    public function createBatch(array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post('batches');
    }

    public function getBalance(): HttpResponse
    {
        return $this->httpClient->get('account/balance');
    }
}
