<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\DocumentServiceInterface;
use D4Sign\Helpers\UploadHelper;

class DocumentService implements DocumentServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function findAll(int $page = 1): HttpResponse
    {
        return $this->httpClient->get("documents", ['pg' => $page]);
    }

    public function findById(string $documentId): HttpResponse
    {
        return $this->httpClient->get("documents/{$documentId}");
    }

    public function findDimensionsById(string $documentId): HttpResponse
    {
        return $this->httpClient->get("documents/{$documentId}/dimensions");
    }

    public function findStatusById(string $statusId, int $page = 1): HttpResponse
    {
        return $this->httpClient->get("documents/{$statusId}/status", ['pg' => $page]);
    }

    public function uploadDocumentByIdSafe(string $safeId, array $fields): HttpResponse
    {
        $file = UploadHelper::getFile($fields['file']);

        $data = [
            $file,
            (function () use ($fields) {
                return [
                    'name' => 'uuid_folder',
                    'contents' => $fields['uuid_folder'] ?? null,
                ];
            })(),
        ];

        return $this->httpClient->asMultipart()->post("documents/{$safeId}/upload", $data);
    }

    public function uploadRelatedDocumentById(string $documentId, array $fields): HttpResponse
    {
        $data = UploadHelper::getFile($fields['file']);

        return $this->httpClient->asMultipart()->post("documents/{$documentId}/uploadslave", $data);
    }

    public function addHighlightById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/addhighlight", $fields);
    }

    public function sendToSignerById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/sendtosigner", $fields);
    }

    public function cancelById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/cancel", $fields);
    }

    public function downloadById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/download", $fields);
    }

    public function resendToSignerById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/resend", $fields);
    }

    public function templates(): HttpResponse
    {
        return $this->httpClient->post('templates');
    }

    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/makedocumentbytemplate", $fields);
    }

    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/makedocumentbytemplateword", $fields);
    }

    public function generateDownloadLink(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->post("documents/{$documentId}/download", $fields);
    }
}
