<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\DocumentServiceInterface;
use D4Sign\Data\Document\{
    CancelDocumentFields,
    HighlightFields,
    SendToSignersFields,
    UploadFields
};
use D4Sign\Exceptions\D4SignConnectException;

class DocumentService implements DocumentServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listDocuments(int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Error listing documents: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentDetails(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$documentId}");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error getting details for document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentDimensions(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$documentId}/dimensions");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error getting dimensions of document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsByPhase(int $statusId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$statusId}/status", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing documents with phase {$statusId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function uploadDocumentToSafe(string $safeId, UploadFields $fields): HttpResponse
    {
        try {
            return $this->httpClient->asMultipart()->post("documents/{$safeId}/upload", $fields->toMultipart());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error sending document to safe {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function uploadRelatedDocument(string $documentId, UploadFields $fields): HttpResponse
    {
        try {
            return $this->httpClient->asMultipart()->post(
                "documents/{$documentId}/uploadslave",
                $fields->toMultipart(),
            );
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error sending document related to document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addDocumentHighlight(string $documentId, HighlightFields $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/addhighlight", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding highlight to document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendDocumentToSigners(string $documentId, SendToSignersFields $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/sendtosigner", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error sending document {$documentId} to signers: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function cancelDocument(string $documentId, CancelDocumentFields $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/cancel", $fields->toArray());
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error canceling document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function downloadDocument(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/download", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error downloading document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resendDocumentToSigners(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/resend", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error resending document {$documentId} to signers: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listTemplates(): HttpResponse
    {
        try {
            return $this->httpClient->post('templates');
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing document templates: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/makedocumentbytemplate", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error creating document from HTML template {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/makedocumentbytemplateword", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error creating document from Word template {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generateDocumentDownloadLink(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/download", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error generating download link for document {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
