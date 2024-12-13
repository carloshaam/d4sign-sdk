<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Contracts\DocumentServiceInterface;
use D4Sign\Helpers\UploadHelper;
use D4Sign\Response;
use D4Sign\Services\BaseService;
use GuzzleHttp\Promise\PromiseInterface;

class DocumentService extends BaseService implements DocumentServiceInterface
{
    public function findAll(int $page = 1): Response
    {
        return $this->get('documents', ['query' => ['pg' => $page]]);
    }

    public function findById(string $documentId): Response
    {
        return $this->get("documents/{$documentId}");
    }

    public function findDimensionsById(string $documentId): Response
    {
        return $this->get("documents/{$documentId}/dimensions");
    }

    public function findStatusById(string $statusId, int $page = 1): Response
    {
        return $this->get("documents/{$statusId}/status", ['query' => ['pg' => $page]]);
    }

    public function uploadDocumentByIdSafe(string $safeId, array $fields): Response
    {
        $file = UploadHelper::getFile($fields['file']);

        $options = [
            'multipart' => [
                $file,
                (function () use ($fields) {
                    return [
                        'name' => 'uuid_folder',
                        'contents' => $fields['uuid_folder'] ?? null,
                    ];
                })(),
            ],
        ];

        return $this->post("documents/{$safeId}/upload", $options);
    }

    public function uploadRelatedDocumentById(string $documentId, array $fields): Response
    {
        $file = UploadHelper::getFile($fields['file']);

        $options = [
            'multipart' => [
                $file,
            ],
        ];

        return $this->post("documents/{$documentId}/uploadslave", $options);
    }

    public function addHighlightById(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/addhighlight", [
            'json' => $fields,
        ]);
    }

    public function sendToSignerById(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/sendtosigner", [
            'json' => $fields,
        ]);
    }

    public function cancelById(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/cancel", [
            'json' => $fields,
        ]);
    }

    public function downloadById(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/download", [
            'json' => $fields,
        ]);
    }

    public function resendToSignerById(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/resend", [
            'json' => $fields,
        ]);
    }

    public function templates(): Response
    {
        return $this->post('templates');
    }

    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/makedocumentbytemplate", [
            'json' => $fields,
        ]);
    }

    public function createDocumentFromWordTemplate(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/makedocumentbytemplateword", [
            'json' => $fields,
        ]);
    }

    public function generateDownloadLink(string $documentId, array $fields): Response
    {
        return $this->post("documents/{$documentId}/download", [
            'json' => $fields,
        ]);
    }
}
