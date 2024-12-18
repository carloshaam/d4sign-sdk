<?php

declare(strict_types=1);

namespace D4Sign\Signatory\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

/**
 * Interface para operações relacionadas aos signatários na API D4Sign.
 */
interface SignatoryServiceInterface
{
    /**
     * Lista todos os signatários de um documento específico.
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de signatários.
     */
    public function listSignatories(string $documentId): HttpResponseInterface;

    /**
     * Lista todos os grupos associados a um cofre específico.
     *
     * @param string $safeId ID do cofre.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de grupos.
     */
    public function listGroupsBySafe(string $safeId): HttpResponseInterface;

    /**
     * Cria uma lista de signatários para um documento.
     *
     * @param string $documentId ID do documento.
     * @param ListSignatoriesFieldsInterface $fields Dados necessários para criar os signatários.
     *
     * @return HttpResponseInterface Resposta HTTP contendo os dados dos signatários criados.
     */
    public function createSignatoryList(string $documentId, ListSignatoriesFieldsInterface $fields): HttpResponseInterface;

    /**
     * Atualiza o e-mail de um signatário em um documento.
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatoryEmailFieldsInterface $fields Dados contendo o novo e-mail do signatário.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatoryEmail(string $documentId, UpdateSignatoryEmailFieldsInterface $fields): HttpResponseInterface;

    /**
     * Atualiza o número de SMS de um signatário em um documento.
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatorySmsNumberFieldsInterface $fields Dados contendo o novo número de SMS.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatorySMSNumber(string $documentId, UpdateSignatorySmsNumberFieldsInterface $fields): HttpResponseInterface;

    /**
     * Atualiza o código de acesso de um signatário em um documento.
     *
     * @param string $documentId ID do documento.
     * @param UpdateSignatoryAccessCodeFieldsInterface $fields Dados contendo o novo código de acesso.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da atualização.
     */
    public function updateSignatoryAccessCode(string $documentId, UpdateSignatoryAccessCodeFieldsInterface $fields): HttpResponseInterface;

    /**
     * Remove um signatário de um documento.
     *
     * @param string $documentId ID do documento.
     * @param RemoveSignatoryFieldsInterface $fields Dados necessários para identificar o signatário a ser removido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeSignatory(string $documentId, RemoveSignatoryFieldsInterface $fields): HttpResponseInterface;

    /**
     * Adiciona um PIN principal a um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados contendo o PIN a ser adicionado.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addMainDocumentPin(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove o PIN principal de um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados necessários para identificar o PIN a ser removido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeMainDocumentPin(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Lista os PINs principais de um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados adicionais para filtrar os resultados.
     *
     * @return HttpResponseInterface Resposta HTTP contendo a lista de PINs.
     */
    public function listMainDocumentPins(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Adiciona informações ao signatário de um documento.
     *
     * @param string $documentId ID do documento.
     * @param CreateSignatoryInformationFieldsInterface $fields Dados contendo as informações adicionais.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addSignatoryInformation(string $documentId, CreateSignatoryInformationFieldsInterface $fields): HttpResponseInterface;

    /**
     * Define o tipo de assinatura de um signatário em um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados contendo o tipo de assinatura a ser definido.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function addSignatorySignatureType(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Obtém detalhes de um grupo de signatários associado a um documento.
     *
     * @param string $documentId ID do documento.
     * @param string $groupId ID do grupo de signatários.
     * @param array $fields Dados adicionais para refinar os detalhes retornados.
     *
     * @return HttpResponseInterface Resposta HTTP contendo os detalhes do grupo.
     */
    public function getSignatoryGroupDetails(string $documentId, string $groupId, array $fields): HttpResponseInterface;

    /**
     * Copia o link de assinatura de um signatário específico.
     *
     * @param string $documentId ID do documento.
     * @param string $signatoryId ID do signatário.
     *
     * @return HttpResponseInterface Resposta HTTP contendo o link de assinatura.
     */
    public function copySignatorySubscriptionLink(string $documentId, string $signatoryId): HttpResponseInterface;

    /**
     * Replica a posição da assinatura de um signatário para outros campos do documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados contendo as informações de replicação.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da operação.
     */
    public function replicateSignaturePosition(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Remove posições de assinatura replicadas de um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados necessários para identificar as posições a serem removidas.
     *
     * @return HttpResponseInterface Resposta HTTP com o status da remoção.
     */
    public function removeReplicatedSignaturePositions(string $documentId, array $fields): HttpResponseInterface;
}
