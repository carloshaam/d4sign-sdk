<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Contracts\SafeServiceInterface;
use D4Sign\Exceptions\D4SignConnectException;

/**
 * Implementação concreta da interface SafeServiceInterface.
 * Utiliza HttpClient para comunicação com a API D4Sign.
 */
class SafeService implements SafeServiceInterface
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
    public function listSafes(): HttpResponse
    {
        try {
            return $this->httpClient->get('safes');
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Erro ao listar as cofres: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsBySafe(string $safeId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$safeId}/safe", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar documentos do cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentsBySafeAndFolder(string $safeId, string $folderId, int $page = 1): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/{$safeId}/safe/{$folderId}", ['pg' => $page]);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao listar documentos da pasta {$folderId} no cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listFolderBySafe(string $safeId): HttpResponse
    {
        try {
            return $this->httpClient->get("folders/{$safeId}/find");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao obter lista de pasta do cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createFolder(string $safeId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("folders/{$safeId}/create", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao criar pasta no cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function renameFolder(string $safeId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("folders/{$safeId}/rename", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Erro ao renomear pasta no cofre {$safeId}: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createDocumentBatch(array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post('batches', $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Erro ao criar documentos em lote: ' . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountBalance(): HttpResponse
    {
        try {
            return $this->httpClient->get('account/balance');
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                'Erro ao obter saldo da conta: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
