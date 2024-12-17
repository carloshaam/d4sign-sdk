<?php

declare(strict_types=1);

namespace D4Sign\Utils;

class D4SignSignatoryAction
{
    public const ACTION_SIGN = 1;
    public const ACTION_APPROVE = 2;
    public const ACTION_ACKNOWLEDGE = 3;
    public const ACTION_SIGN_AS_PARTY = 4;
    public const ACTION_SIGN_AS_WITNESS = 5;
    public const ACTION_SIGN_AS_INTERVENING = 6;
    public const ACTION_RECEIPT_ACKNOWLEDGEMENT = 7;
    public const ACTION_SIGN_AS_ISSUER_ENDORSER_SURETY = 8;
    public const ACTION_SIGN_AS_ISSUER_ENDORSER_SURETY_GUARANTOR = 9;
    public const ACTION_SIGN_AS_GUARANTOR = 10;
    public const ACTION_SIGN_AS_PARTY_AND_GUARANTOR = 11;
    public const ACTION_SIGN_AS_SOLIDARITY_RESPONSIBLE = 12;
    public const ACTION_SIGN_AS_PARTY_AND_SOLIDARITY_RESPONSIBLE = 13;

    private const DESCRIPTIONS = [
        self::ACTION_SIGN => 'Assinar',
        self::ACTION_APPROVE => 'Aprovar',
        self::ACTION_ACKNOWLEDGE => 'Reconhecer',
        self::ACTION_SIGN_AS_PARTY => 'Assinar como parte',
        self::ACTION_SIGN_AS_WITNESS => 'Assinar como testemunha',
        self::ACTION_SIGN_AS_INTERVENING => 'Assinar como interveniente',
        self::ACTION_RECEIPT_ACKNOWLEDGEMENT => 'Acusar recebimento',
        self::ACTION_SIGN_AS_ISSUER_ENDORSER_SURETY => 'Assinar como Emissor, Endossante e Avalista',
        self::ACTION_SIGN_AS_ISSUER_ENDORSER_SURETY_GUARANTOR => 'Assinar como Emissor, Endossante, Avalista, Fiador',
        self::ACTION_SIGN_AS_GUARANTOR => 'Assinar como fiador',
        self::ACTION_SIGN_AS_PARTY_AND_GUARANTOR => 'Assinar como parte e fiador',
        self::ACTION_SIGN_AS_SOLIDARITY_RESPONSIBLE => 'Assinar como responsável solidário',
        self::ACTION_SIGN_AS_PARTY_AND_SOLIDARITY_RESPONSIBLE => 'Assinar como parte e responsável solidário',
    ];

    /**
     * Retorna a descrição de uma ação específica
     *
     * @param int $action
     *
     * @return string|null
     */
    public static function getDescription(int $action): ?string
    {
        return self::DESCRIPTIONS[$action] ?? null;
    }

    /**
     * Retorna todas as ações disponíveis como chave e descrições
     *
     * @return array<int, string>
     */
    public static function all(): array
    {
        return self::DESCRIPTIONS;
    }
}
