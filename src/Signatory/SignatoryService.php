<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\SignatoryServiceInterface;

class SignatoryService implements SignatoryServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function findAll(string $documentId): HttpResponse
    {
        return $this->httpClient->get("documents/{$documentId}/list");
    }

    public function findGroupsByIdSafe(string $safeId): HttpResponse
    {
        return $this->httpClient->get("groups/{$safeId}");
    }

    public function createSignatoryByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/createlist");
    }

    public function updateEmailByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/changeemail");
    }

    public function updateSMSNumberByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/changesmsnumber");
    }

    public function updateAccessCodeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/changepasswordcode");
    }

    public function removeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/removeemaillist");
    }

    /*public function addPinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/addpins");
    }*/

    /*public function removePinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/removepins");
    }*/

    /*public function findAllPinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/listpins");
    }*/

    public function addInformationSignatoryByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/addinfo");
    }

    public function addSignatoryTypeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/addsignaturetype");
    }

    public function findDetailGroupSignatoryByIdDocumentAndIdGroup(string $documentId, string $groupId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/groupdetails/{$groupId}");
    }
}
