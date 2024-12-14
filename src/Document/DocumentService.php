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
        return $this->httpClient->withQuery(['pg' => $page])->get('documents');
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
        return $this->httpClient->withQuery(['pg' => $page])->get("documents/{$statusId}/status");
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

        return $this->httpClient->withMultipart($data)->post("documents/{$safeId}/upload");
    }

    public function uploadRelatedDocumentById(string $documentId, array $fields): HttpResponse
    {
        $file = UploadHelper::getFile($fields['file']);

        return $this->httpClient->withMultipart($file)->post("documents/{$documentId}/uploadslave");
    }

    public function addHighlightById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/addhighlight");
    }

    public function sendToSignerById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/sendtosigner");
    }

    public function cancelById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/cancel");
    }

    public function downloadById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/download");
    }

    public function resendToSignerById(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/resend");
    }

    public function templates(): HttpResponse
    {
        return $this->httpClient->post('templates');
    }

    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/makedocumentbytemplate");
    }

    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/makedocumentbytemplateword");
    }

    public function generateDownloadLink(string $documentId, array $fields): HttpResponse
    {
        return $this->httpClient->withJson($fields)->post("documents/{$documentId}/download");
    }
}
