<?php

declare(strict_types=1);

namespace D4Sign\Client;

class D4SignClient
{
    private HttpClient $httpClient;

    public function __construct(
        string $tokenAPI,
        string $cryptKey,
        string $baseUrl = 'https://sandbox.d4sign.com.br/api/v1'
    ) {
        $this->httpClient = HttpClient::new()
            ->baseUrl($baseUrl)
            ->withHeaders([
                'tokenAPI' => $tokenAPI,
                'cryptKey' => $cryptKey,
            ]);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
