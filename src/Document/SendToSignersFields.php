<?php

declare(strict_types=1);

namespace D4Sign\Document;

use D4Sign\Document\Contracts\SendToSignersFieldsInterface;
use D4Sign\Exceptions\D4SignInvalidArgumentException;

class SendToSignersFields implements SendToSignersFieldsInterface
{
    private string $skipEmail;
    private string $workflow;
    private ?string $message = null;
    private ?string $tokenAPI = null;

    /**
     * @param string $skipEmail Se o envio do e-mail deve ser pulado ("0" ou "1").
     * @param string $workflow Define se o workflow está ativado ou não ("0" ou "1").
     */
    public function __construct(string $skipEmail, string $workflow)
    {
        if (! in_array($skipEmail, ['0', '1'], true)) {
            throw new D4SignInvalidArgumentException('O campo "skip_email" deve ser "0" ou "1".');
        }

        $this->skipEmail = $skipEmail;

        if (! in_array($workflow, ['0', '1'], true)) {
            throw new D4SignInvalidArgumentException('O campo "workflow" deve ser "0" ou "1".');
        }

        $this->workflow = $workflow;
    }

    /**
     * Configura a mensagem para o signatário.
     *
     * @param string $message Mensagem para o signatário.
     *
     * @return self
     * @throws D4SignInvalidArgumentException Se a mensagem for definida quando skipEmail == "1".
     */
    public function setMessage(string $message): self
    {
        if ($this->skipEmail === '1') {
            throw new D4SignInvalidArgumentException(
                'O campo "message" não pode ser definido quando "skip_email" for "1".',
            );
        }

        $this->message = $message;

        return $this;
    }

    /**
     * Configura o token da API.
     *
     * @param string $tokenAPI Token do usuário.
     *
     * @return self
     */
    public function setTokenAPI(string $tokenAPI): self
    {
        $this->tokenAPI = $tokenAPI;

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
            'skip_email' => $this->skipEmail,
            'workflow' => $this->workflow,
        ];

        if ($this->message !== null) {
            $data['message'] = $this->message;
        }

        if ($this->tokenAPI !== null) {
            $data['tokenAPI'] = $this->tokenAPI;
        }

        return $data;
    }
}
