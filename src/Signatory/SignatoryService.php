<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Contracts\SignatoryServiceInterface;
use D4Sign\Response;
use D4Sign\Services\BaseService;

class SignatoryService extends BaseService implements SignatoryServiceInterface
{
    public function findAll(string $documentId): Response
    {
        return $this->get("documents/{$documentId}/list");
    }

    public function findGroupsByIdSafe(string $safeId): Response
    {
        return $this->get("groups/{$safeId}");
    }

    public function createSignatoryByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/createlist", [
            'json' => $fields,
        ]);
    }

    public function updateEmailByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/changeemail", [
            'json' => $fields,
        ]);
    }

    public function updateSMSNumberByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/changesmsnumber", [
            'json' => $fields,
        ]);
    }

    public function updateAccessCodeByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/changepasswordcode", [
            'json' => $fields,
        ]);
    }

    public function removeByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/removeemaillist", [
            'json' => $fields,
        ]);
    }

    /*public function addPinByIdMainDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/addpins", [
            'json' => $fields,
        ]);
    }*/

    /*public function removePinByIdMainDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/removepins", [
            'json' => $fields,
        ]);
    }*/

    /*public function findAllPinByIdMainDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/listpins", [
            'json' => $fields,
        ]);
    }*/

    public function addInformationSignatoryByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/addinfo", [
            'json' => $fields,
        ]);
    }

    public function addSignatoryTypeByIdDocument(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/addsignaturetype", [
            'json' => $fields,
        ]);
    }

    public function findDetailGroupSignatoryByIdDocumentAndIdGroup(string $documentId, string $groupId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/groupdetails/{$groupId}", [
            'json' => $fields,
        ]);
    }
}
