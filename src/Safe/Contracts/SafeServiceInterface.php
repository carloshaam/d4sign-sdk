<?php

declare(strict_types=1);

namespace D4Sign\Safe\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

/**
 * Interface para manipulação de cofres e pastas no serviço D4Sign.
 */
interface SafeServiceInterface
{
    /**
     * Lista todos os cofres disponíveis na conta.
     *
     * @return HttpResponseInterface Retorna a resposta da API com a lista de cofres.
     */
    public function listSafes(): HttpResponseInterface;

    /**
     * Lista todos os documentos de um cofre específico.
     *
     * @param string $safeId ID do cofre.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos do cofre.
     */
    public function listDocumentsBySafe(string $safeId, int $page = 1): HttpResponseInterface;

    /**
     * Lista documentos de um cofre numa pasta específica.
     *
     * @param string $safeId ID do cofre.
     * @param string $folderId ID da pasta dentro do cofre.
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos da pasta.
     */
    public function listDocumentsBySafeAndFolder(
        string $safeId,
        string $folderId,
        int $page = 1
    ): HttpResponseInterface;

    /**
     * Obtém lista de todas as pasta dentro do cofre.
     *
     * @param string $safeId ID do cofre.
     *
     * @return HttpResponseInterface Retorna a resposta da API com os detalhes das pastas.
     */
    public function listFolderBySafe(string $safeId): HttpResponseInterface;

    /**
     * Cria uma nova pasta dentro de um cofre.
     *
     * @param string $safeId ID do cofre onde a pasta será criada.
     * @param CreateFolderFieldsInterface $fields Dados necessários para a criação da pasta.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a criação da pasta.
     */
    public function createFolder(string $safeId, CreateFolderFieldsInterface $fields): HttpResponseInterface;

    /**
     * Renomeia uma pasta existente num cofre.
     *
     * @param string $safeId ID do cofre onde a pasta está localizada.
     * @param array $fields Dados necessários para renomear a pasta.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a renomeação.
     */
    public function renameFolder(string $safeId, array $fields): HttpResponseInterface;

    /**
     * Cria documentos em lote num cofre.
     *
     * @param array $fields Dados necessários para criar os documentos.
     *
     * @return HttpResponseInterface Retorna a resposta da API após a criação dos documentos.
     */
    public function createDocumentBatch(array $fields): HttpResponseInterface;

    /**
     * Obtém o saldo da conta.
     *
     * @return HttpResponseInterface Retorna a resposta da API com o saldo disponível.
     */
    public function getAccountBalance(): HttpResponseInterface;
}
