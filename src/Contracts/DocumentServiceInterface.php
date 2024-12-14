<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

interface DocumentServiceInterface
{
    public function findAll(int $page = 1): HttpResponseInterface;

    public function findById(string $documentId): HttpResponseInterface;

    public function findDimensionsById(string $documentId): HttpResponseInterface;

    public function findStatusById(string $statusId, int $page = 1): HttpResponseInterface;

    public function uploadDocumentByIdSafe(string $safeId, array $fields): HttpResponseInterface;

    public function uploadRelatedDocumentById(string $documentId, array $fields): HttpResponseInterface;

    public function addHighlightById(string $documentId, array $fields): HttpResponseInterface;

    public function sendToSignerById(string $documentId, array $fields): HttpResponseInterface;

    public function cancelById(string $documentId, array $fields): HttpResponseInterface;

    public function downloadById(string $documentId, array $fields): HttpResponseInterface;

    public function resendToSignerById(string $documentId, array $fields): HttpResponseInterface;

    public function templates(): HttpResponseInterface;

    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponseInterface;

    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponseInterface;

    public function generateDownloadLink(string $documentId, array $fields): HttpResponseInterface;
}
