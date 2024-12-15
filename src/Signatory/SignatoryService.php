<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\SignatoryServiceInterface;
use D4Sign\Exceptions\D4SignConnectException;

class SignatoryService implements SignatoryServiceInterface
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
    public function listSignatories(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$documentId}/list");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar signatários para o documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listGroupsBySafe(string $safeId): HttpResponse
    {
        try {
            return $this->httpClient->get("groups/{$safeId}");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar grupos para o cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createSignatoryList(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/createlist", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao criar lista de signatários para o documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryEmail(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/changeemail", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao atualizar o e-mail do signatário no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatorySMSNumber(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/changesmsnumber", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao atualizar o número de SMS do signatário no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryAccessCode(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/changepasswordcode", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao atualizar o código de acesso do signatário no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeSignatory(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/removeemaillist", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao remover o signatário do documento {$documentId}: " . $e->getMessage(), $e->getCode(), $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/addpins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao adicionar PIN ao documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/removepins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao remover PIN do documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listMainDocumentPins(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/listpins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar PINs do documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatoryInformation(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/addinfo", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao adicionar informações ao signatário do documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatorySignatureType(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/addsignaturetype", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao adicionar tipo de assinatura ao signatário no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatoryGroupDetails(string $documentId, string $groupId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/groupdetails/{$groupId}", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao obter detalhes do grupo de signatários no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function copySignatorySubscriptionLink(string $documentId, string $signatoryId): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/signaturelink/{$signatoryId}");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao copiar o link de assinatura do signatário {$signatoryId} no documento {$documentId}: " . $e->getMessage(
                ), $e->getCode(), $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function replicateSignaturePosition(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/addpinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao replicar a posição de assinatura no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeReplicatedSignaturePositions(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/{$documentId}/removepinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao remover posições de assinatura replicadas no documento {$documentId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
