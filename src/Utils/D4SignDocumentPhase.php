<?php

declare(strict_types=1);

namespace D4Sign\Utils;

class D4SignDocumentPhase
{
    public const PHASE_PROCESSING = 1;
    public const PHASE_WAITING_FOR_SIGNATORIES = 2;
    public const PHASE_WAITING_FOR_SIGNATURES = 3;
    public const PHASE_COMPLETED = 4;
    public const PHASE_ARCHIVED = 5;
    public const PHASE_CANCELLED = 6;
    public const PHASE_EDITING = 7;

    private const DESCRIPTIONS = [
        self::PHASE_PROCESSING => 'Processando',
        self::PHASE_WAITING_FOR_SIGNATORIES => 'Aguardando Signatários',
        self::PHASE_WAITING_FOR_SIGNATURES => 'Aguardando Assinaturas',
        self::PHASE_COMPLETED => 'Finalizado',
        self::PHASE_ARCHIVED => 'Arquivado',
        self::PHASE_CANCELLED => 'Cancelado',
        self::PHASE_EDITING => 'Editando',
    ];

    /**
     * Retorna a descrição de uma fase específica
     *
     * @param int $phase
     *
     * @return string|null
     */
    public static function getDescription(int $phase): ?string
    {
        return self::DESCRIPTIONS[$phase] ?? null;
    }

    /**
     * Retorna todas as fases disponíveis como chave e suas descrições
     *
     * @return array<int, string>
     */
    public static function all(): array
    {
        return self::DESCRIPTIONS;
    }
}
