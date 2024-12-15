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
        return $this->httpClient->post("documents/{$documentId}/createlist", $fields);
    }

    public function updateEmailByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/changeemail", $fields);
    }

    public function updateSMSNumberByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/changesmsnumber", $fields);
    }

    public function updateAccessCodeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/changepasswordcode", $fields);
    }

    public function removeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/removeemaillist", $fields);
    }

    /*public function addPinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/addpins", $fields);
    }*/

    /*public function removePinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/removepins", $fields);
    }*/

    /*public function findAllPinByIdMainDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/listpins", $fields);
    }*/

    public function addInformationSignatoryByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/addinfo", $fields);
    }

    public function addSignatoryTypeByIdDocument(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/addsignaturetype", $fields);
    }

    public function findDetailGroupSignatoryByIdDocumentAndIdGroup(
        string $documentId,
        string $groupId,
        array $fields
    ): HttpResponse {
        return $this->httpClient->post("documents/{$documentId}/groupdetails/{$groupId}", $fields);
    }
}
