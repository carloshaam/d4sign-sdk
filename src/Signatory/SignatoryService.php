<?php

declare(strict_types=1);

namespace D4Sign\Signatory;

use D4Sign\Client\HttpClient;
use D4Sign\Client\HttpResponse;
use D4Sign\Exceptions\D4SignConnectException;
use D4Sign\Signatory\Contracts\SignatoryServiceInterface;

class SignatoryService implements SignatoryServiceInterface
{
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function listSignatories(string $documentId): HttpResponse
    {
        try {
            return $this->httpClient->get("documents/$documentId/list");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing signers for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listGroupsBySafe(string $safeId): HttpResponse
    {
        try {
            return $this->httpClient->get("groups/$safeId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing groups for safe $safeId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function createSignatoryList(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/createlist", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error creating signer list for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryEmail(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changeemail", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer email in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatorySMSNumber(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changesmsnumber", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer's SMS number in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function updateSignatoryAccessCode(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/changepasswordcode", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error updating signer access code in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeSignatory(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removeemaillist", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing signer from document $documentId: " . $e->getMessage(), $e->getCode(), $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addpins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding PIN to document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeMainDocumentPin(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removepins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing PIN from document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listMainDocumentPins(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/listpins", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error listing PINs for document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatoryInformation(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addinfo", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding information for signer of document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addSignatorySignatureType(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addsignaturetype", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error adding signature type to signer in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatoryGroupDetails(string $documentId, string $groupId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/groupdetails/$groupId", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error getting signer group details on document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function copySignatorySubscriptionLink(string $documentId, string $signatoryId): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/signaturelink/$signatoryId");
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error copying signature link from signatory $signatoryId into document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function replicateSignaturePosition(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/addpinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error replicating signature position in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeReplicatedSignaturePositions(string $documentId, array $fields): HttpResponse
    {
        try {
            return $this->httpClient->post("documents/$documentId/removepinswithreplics", $fields);
        } catch (\Throwable $e) {
            throw new D4SignConnectException(
                "Error removing replicated signature positions in document $documentId: " . $e->getMessage(),
                $e->getCode(),
                $e,
            );
        }
    }
}
