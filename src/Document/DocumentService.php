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

/**
 * Implementação concreta de DocumentServiceInterface.
 * Gerencia a comunicação com a API D4Sign para operações relacionadas a documentos.
 */
class DocumentService implements DocumentServiceInterface
{
    /**
     * @var HttpClient Cliente HTTP utilizado para interagir com a API.
     */
    private HttpClient $httpClient;

    /**
     * Construtor da classe.
     *
     * @param HttpClient $httpClient Instância do cliente HTTP.
     */
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
                'Erro ao listar documentos: ' . $e->getMessage(),
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
                "Erro ao obter detalhes do documento {$documentId}: " . $e->getMessage(),
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
                "Erro ao obter dimensões do documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsByStatus(string $statusId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$statusId}/status", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar documentos com status {$statusId}: " . $e->getMessage(),
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
                "Erro ao enviar documento para o cofre {$safeId}: " . $e->getMessage(),
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
                "Erro ao enviar documento relacionado ao documento {$documentId}: " . $e->getMessage(),
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
                "Erro ao adicionar destaque ao documento {$documentId}: " . $e->getMessage(),
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
                "Erro ao enviar documento {$documentId} para os signatários: " . $e->getMessage(),
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
                "Erro ao cancelar o documento {$documentId}: " . $e->getMessage(),
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
                "Erro ao baixar o documento {$documentId}: " . $e->getMessage(),
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
                "Erro ao reenviar documento {$documentId} para os signatários: " . $e->getMessage(),
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
                "Erro ao listar modelos de documentos: " . $e->getMessage(),
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
                "Erro ao criar documento a partir do modelo HTML {$documentId}: " . $e->getMessage(),
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
                "Erro ao criar documento a partir do modelo Word {$documentId}: " . $e->getMessage(),
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
                "Erro ao gerar link de download para o documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
