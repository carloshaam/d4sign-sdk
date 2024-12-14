<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface SignatoryServiceInterface
{
    public function findAll(string $documentId): HttpResponseInterface;

    public function findGroupsByIdSafe(string $safeId): HttpResponseInterface;

    public function createSignatoryByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function updateEmailByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function updateSMSNumberByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function updateAccessCodeByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function removeByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    /*public function addPinByIdMainDocument(string $documentId, array $fields): HttpResponseInterface;*/

    /*public function removePinByIdMainDocument(string $documentId, array $fields): HttpResponseInterface;*/

    /*public function findAllPinByIdMainDocument(string $documentId, array $fields): HttpResponseInterface;*/

    public function addInformationSignatoryByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function addSignatoryTypeByIdDocument(string $documentId, array $fields): HttpResponseInterface;

    public function findDetailGroupSignatoryByIdDocumentAndIdGroup(string $documentId, string $groupId, array $fields): HttpResponseInterface;
}
