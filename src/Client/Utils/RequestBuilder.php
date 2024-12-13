<?php

declare(strict_types=1);

namespace D4Sign\Client\Utils;

use D4Sign\Client\Contracts\HttpClientInterface;
use D4Sign\Response;

class RequestBuilder
{
    private array $query = [];
    private array $headers = [];
    private array $json = [];
    private array $multipart = [];
    private array $formParams = [];
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Adiciona um parâmetro na query string.
     */
    public function withQuery(array $data): self
    {
        $this->query = array_merge($this->query, $data);
        return $this;
    }

    /**
     * Adiciona headers personalizados.
     */
    public function withHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Define o corpo da requisição no formato JSON.
     */
    public function withJson(array $data): self
    {
        $this->json = $data;
        return $this;
    }

    /**
     * Define o corpo da requisição no formato multipart.
     */
    public function withMultipart(array $data): self
    {
        foreach ($data as $name => $contents) {
            $this->multipart[] = [
                'name' => $name,
                'contents' => $contents,
            ];
        }
        return $this;
    }

    /**
     * Define o corpo da requisição no formato form_params.
     */
    public function withFormParams(array $data): self
    {
        $this->formParams = $data;
        return $this;
    }

    /**
     * Monta e envia uma requisição GET.
     */
    public function get(string $uri): Response
    {
        return $this->send('GET', $uri);
    }

    /**
     * Monta e envia uma requisição POST.
     */
    public function post(string $uri): Response
    {
        return $this->send('POST', $uri);
    }

    /**
     * Monta e envia uma requisição PUT.
     */
    public function put(string $uri): Response
    {
        return $this->send('PUT', $uri);
    }

    /**
     * Monta e envia uma requisição DELETE.
     */
    public function delete(string $uri): Response
    {
        return $this->send('DELETE', $uri);
    }

    /**
     * Combinador interno para construir a requisição com base nos dados fornecidos.
     */
    private function send(string $method, string $uri): Response
    {
        $options = [];
        if (!empty($this->query)) {
            $options['query'] = $this->query;
        }
        if (!empty($this->headers)) {
            $options['headers'] = $this->headers;
        }
        if (!empty($this->json)) {
            $options['json'] = $this->json;
        }
        if (!empty($this->multipart)) {
            $options['multipart'] = $this->multipart;
        }
        if (!empty($this->formParams)) {
            $options['form_params'] = $this->formParams;
        }

        return $this->client->{$method}($uri, $options);
    }
}
