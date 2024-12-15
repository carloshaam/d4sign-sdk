<?php

declare(strict_types=1);

namespace D4Sign\Contracts;

use D4Sign\Client\Contracts\HttpResponseInterface;

/**
 * Interface para gerenciamento de documentos no serviço D4Sign.
 */
interface DocumentServiceInterface
{
    /**
     * Lista todos os documentos disponíveis.
     *
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna a resposta da API com os documentos listados.
     */
    public function listDocuments(int $page = 1): HttpResponseInterface;

    /**
     * Obtém os detalhes de um documento específico.
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Retorna a resposta da API com os detalhes do documento.
     */
    public function getDocumentDetails(string $documentId): HttpResponseInterface;

    /**
     * Obtém as dimensões de um documento específico.
     *
     * @param string $documentId ID do documento.
     *
     * @return HttpResponseInterface Retorna as dimensões do documento em formato JSON.
     */
    public function getDocumentDimensions(string $documentId): HttpResponseInterface;

    /**
     * Lista documentos com base no status especificado.
     *
     * @param string $statusId ID do status (por exemplo: pendente, assinado).
     * @param int $page Número da página para paginação (padrão: 1).
     *
     * @return HttpResponseInterface Retorna os documentos que correspondem ao status informado.
     */
    public function listDocumentsByStatus(string $statusId, int $page = 1): HttpResponseInterface;

    /**
     * Faz o upload de um novo documento para um cofre específico.
     *
     * @param string $safeId ID do cofre.
     * @param array $fields Dados do documento (nome, arquivo, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API após o upload do documento.
     */
    public function uploadDocumentToSafe(string $safeId, array $fields): HttpResponseInterface;

    /**
     * Faz o upload de um documento relacionado a um documento existente.
     *
     * @param string $documentId ID do documento principal.
     * @param array $fields Dados do documento relacionado.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o upload.
     */
    public function uploadRelatedDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Adiciona um destaque em um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados do destaque (como posição, cor, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API após a adição do destaque.
     */
    public function addDocumentHighlight(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Envia um documento para os signatários.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados para o envio, como e-mails dos signatários.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o envio.
     */
    public function sendDocumentToSigners(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Cancela um documento em processo de assinatura.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Motivo do cancelamento ou outras informações.
     *
     * @return HttpResponseInterface Retorna a resposta da API após o cancelamento.
     */
    public function cancelDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Faz o download de um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Configurações do download (como formato ou opções adicionais).
     *
     * @return HttpResponseInterface Retorna o conteúdo do documento em binário ou base64.
     */
    public function downloadDocument(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Reenvia o documento para os signatários.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Dados do reenvio (e-mails, mensagens, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API após o reenvio.
     */
    public function resendDocumentToSigners(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Lista os modelos de documentos disponíveis.
     *
     * @return HttpResponseInterface Retorna a lista de modelos cadastrados.
     */
    public function listTemplates(): HttpResponseInterface;

    /**
     * Cria um documento a partir de um modelo HTML.
     *
     * @param string $documentId ID do modelo.
     * @param array $fields Dados necessários para preencher o modelo.
     *
     * @return HttpResponseInterface Retorna a resposta da API com o novo documento criado.
     */
    public function createDocumentFromHtmlTemplate(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Cria um documento a partir de um modelo Word.
     *
     * @param string $documentId ID do modelo.
     * @param array $fields Dados necessários para preencher o modelo.
     *
     * @return HttpResponseInterface Retorna a resposta da API com o novo documento criado.
     */
    public function createDocumentFromWordTemplate(string $documentId, array $fields): HttpResponseInterface;

    /**
     * Gera um link para download de um documento.
     *
     * @param string $documentId ID do documento.
     * @param array $fields Configurações do link de download (como validade, senha, etc.).
     *
     * @return HttpResponseInterface Retorna a resposta da API com o link gerado.
     */
    public function generateDocumentDownloadLink(string $documentId, array $fields): HttpResponseInterface;
}
