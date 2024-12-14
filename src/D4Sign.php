<?php

declare(strict_types=1);

namespace D4Sign;

use D4Sign\Certificate\CertificateService;
use D4Sign\Client\D4SignClient;
use D4Sign\Contracts\CertificateServiceInterface;
use D4Sign\Contracts\DocumentServiceInterface;
use D4Sign\Contracts\SafeServiceInterface;
use D4Sign\Contracts\SignatoryServiceInterface;
use D4Sign\Contracts\TagServiceInterface;
use D4Sign\Contracts\UserServiceInterface;
use D4Sign\Contracts\WatcherServiceInterface;
use D4Sign\Contracts\WebhookServiceInterface;
use D4Sign\Document\DocumentService;
use D4Sign\Safe\SafeService;
use D4Sign\Signatory\SignatoryService;
use D4Sign\Tag\TagService;
use D4Sign\User\UserService;
use D4Sign\Watcher\WatcherService;
use D4Sign\Webhook\WebhookService;

class D4Sign
{
    private D4SignClient $client;
    private array $services = [];

    public function __construct(
        string $tokenAPI,
        string $cryptKey,
        string $baseUrl = 'https://sandbox.d4sign.com.br/api/v1'
    ) {
        $this->client = new D4SignClient($tokenAPI, $cryptKey, $baseUrl);
    }

    private function getService(string $service, string $class): object
    {
        if (! isset($this->services[$service])) {
            $this->services[$service] = new $class($this->client->getHttpClient());
        }

        return $this->services[$service];
    }

    public function safes(): SafeServiceInterface
    {
        return $this->getService('safes', SafeService::class);
    }

    public function documents(): DocumentServiceInterface
    {
        return $this->getService('documents', DocumentService::class);
    }

    public function signatories(): SignatoryServiceInterface
    {
        return $this->getService('signatories', SignatoryService::class);
    }

    public function users(): UserServiceInterface
    {
        return $this->getService('users', UserService::class);
    }

    public function tags(): TagServiceInterface
    {
        return $this->getService('tags', TagService::class);
    }

    public function certificates(): CertificateServiceInterface
    {
        return $this->getService('certificates', CertificateService::class);
    }

    public function watchers(): WatcherServiceInterface
    {
        return $this->getService('watchers', WatcherService::class);
    }

    public function webhooks(): WebhookServiceInterface
    {
        return $this->getService('webhooks', WebhookService::class);
    }
}
