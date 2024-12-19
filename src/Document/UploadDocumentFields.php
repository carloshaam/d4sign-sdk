<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Document\Contracts\UploadDocumentFieldsInterface;
use GuzzleHttp\Psr7\Utils;

class UploadDocumentFields implements UploadDocumentFieldsInterface
{
    private string $filePath;
    private ?string $uuidFolder = null;
    private ?string $customName = null;
    private array $metadata = [];

    /**
     * @param string $filePath Caminho do arquivo a ser enviado.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Define a pasta do cofre (UUID).
     *
     * @param string $uuidFolder ID da pasta no cofre.
     *
     * @return self
     */
    public function setUuidFolder(string $uuidFolder): self
    {
        $this->uuidFolder = $uuidFolder;

        return $this;
    }

    /**
     * Define o nome customizado do arquivo a ser enviado.
     *
     * @param string $customName Nome customizado do documento.
     *
     * @return self
     */
    public function setCustomName(string $customName): self
    {
        $this->customName = $customName;

        return $this;
    }

    /**
     * Adiciona um metadado ao envio do documento.
     *
     * @param string $key Chave do metadado.
     * @param string $value Valor do metadado.
     *
     * @return self
     */
    public function addMetadata(string $key, string $value): self
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    /**
     * Converte os dados para uma estrutura compatível com a API.
     *
     * @return array Estrutura formatada.
     */
    public function toArray(): array
    {
        $data = [
            [
                'name' => 'file',
                'contents' => Utils::tryFopen($this->filePath, 'r'),
            ],
        ];

        if ($this->uuidFolder) {
            $data[] = [
                'name' => 'uuid_folder',
                'contents' => $this->uuidFolder,
            ];
        }

        if ($this->customName) {
            $data[] = [
                'name' => 'name',
                'contents' => $this->customName,
            ];
        }

        foreach ($this->metadata as $key => $value) {
            $data[] = [
                'name' => "metadata[{$key}]",
                'contents' => $value,
            ];
        }

        return $data;
    }
}
