<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch government and public-sector organization names.
 *
 * This abbreviator handles government bodies and public-sector organization
 * terms, such as "Gemeente", "Provincie", "Omgevingsdienst",
 * "Kamer van Koophandel" and "Gemeentelijke Gezondheidsdienst".
 */
final class GovernmentAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])kamer van koophandel(?![\pL\pN])~iu' => 'KvK',
        '~(?<![\pL\pN])gemeentelijke gezondheidsdienst(?![\pL\pN])~iu' => 'GGD',
        '~(?<![\pL\pN])openbaar ministerie(?![\pL\pN])~iu' => 'OM',
        '~(?<![\pL\pN])raad van state(?![\pL\pN])~iu' => 'RvS',
        '~(?<![\pL\pN])gemeentelijke sociale dienst(?![\pL\pN])~iu' => 'GSD',
        '~(?<![\pL\pN])omgevingsdienst(?![\pL\pN])~iu' => 'OD',
        '~(?<![\pL\pN])belastingdienst(?![\pL\pN])~iu' => 'BD',
        '~(?<![\pL\pN])rijksdienst(?![\pL\pN])~iu' => 'RD',
        '~(?<![\pL\pN])(g)emeente(?![\pL\pN])~iu' => '$1em',
        '~(?<![\pL\pN])(p)rovincie(?![\pL\pN])~iu' => '$1rov',
        '~(?<![\pL\pN])(m)inisterie(?![\pL\pN])~iu' => '$1in',
        '~(?<![\pL\pN])(r)echtbank(?![\pL\pN])~iu' => '$1b',
        '~(?<![\pL\pN])(w)aterschap(?![\pL\pN])~iu' => '$1s',
    ];

    private const array ABBREVIATIONS = [
        'kvk',
        'ggd',
        'gsd',
        'om',
        'rvs',
        'sd',
        'od',
        'bd',
        'rd',
        'gem',
        'prov',
        'min',
        'rb',
        'ws',
    ];

    private array $lookup;
    private array $replace;

    public function __construct()
    {
        $this->lookup = array_keys(self::REPLACEMENTS);
        $this->replace = array_values(self::REPLACEMENTS);
    }

    /**
     * {@inheritDoc}
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace($this->lookup, $this->replace, $phrase);
    }

    /**
     * {@inheritDoc}
     */
    public function isAbbreviated(string $word): bool
    {
        return in_array(strtolower($word), self::ABBREVIATIONS, true);
    }
}
