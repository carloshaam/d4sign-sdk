<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Document\Contracts\HighlightFieldsInterface;

class HighlightFields implements HighlightFieldsInterface
{
    private string $email;
    private ?string $keySigner = null;
    private ?string $text = null;

    /**
     * @param string $email E-mail do signatário.
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Define a chave do signatário.
     *
     * @param string $keySigner Chave do signatário (Base64).
     *
     * @return self
     */
    public function setKeySigner(string $keySigner): self
    {
        $this->keySigner = $keySigner;

        return $this;
    }

    /**
     * Define o texto que será destacado.
     *
     * @param string $text Texto a ser destacado no documento.
     *
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;

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
            'email' => $this->email,
        ];

        if ($this->keySigner !== null) {
            $data['key_signer'] = $this->keySigner;
        }

        if ($this->text !== null) {
            $data['text'] = $this->text;
        }

        return $data;
    }
}
