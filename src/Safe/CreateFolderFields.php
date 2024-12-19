<?php

declare(strict_types=1);

namespace D4Sign\Safe;

use D4Sign\Safe\Contracts\CreateFolderFieldsInterface;

class CreateFolderFields implements CreateFolderFieldsInterface
{
    private string $folderName;
    private ?string $uuidFolder = null;

    /**
     * @param string $folderName Nome da pasta ou subpasta.
     */
    public function __construct(string $folderName)
    {
        $this->folderName = $folderName;
    }

    /**
     * Cria pasta ou subpasta no cofre.
     *
     * @param string $uuidFolder Chave da pasta.
     *
     * @return self
     */
    public function setUuidFolder(string $uuidFolder): self
    {
        $this->uuidFolder = $uuidFolder;

        return $this;
    }

    /**
     * Retorna os dados formatados para a API.
     *
     * @return array Dados no formato correto.
     */
    public function toArray(): array
    {
        $data = [
            'folder_name' => $this->folderName,
        ];

        if ($this->uuidFolder !== null) {
            $data['uuid_folder'] = $this->uuidFolder;
        }

        return $data;
    }
}
