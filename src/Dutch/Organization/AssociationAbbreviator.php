<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch association forms in organization names.
 *
 * This abbreviator handles full association descriptions and common compound
 * forms, such as "Vereniging van Eigenaren", "Vereniging Openbaar Onderwijs"
 * and "VoetbalVereniging".
 */
final class AssociationAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])vereniging van nederlandse gemeenten(?![\pL\pN])~iu' => 'VNG',
        '~(?<![\pL\pN])vereniging van eigenaren(?![\pL\pN])~iu' => 'VvE',
        '~(?<![\pL\pN])vereniging openbaar onderwijs(?![\pL\pN])~iu' => 'VOO',
        '~(?<![\pL\pN])voetbalvereniging(?![\pL\pN])~iu' => 'VV',
        '~(?<![\pL\pN])sportvereniging(?![\pL\pN])~iu' => 'SV',
        '~(?<![\pL\pN])vereniging(?![\pL\pN])~iu' => 'Ver',
    ];

    private const array ABBREVIATIONS = [
        'vng',
        'vve',
        'voo',
        'vv',
        'sv',
        'ver',
    ];

    /**
     * {@inheritDoc}
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $phrase = preg_replace($regex, $replacement, $phrase);
        }

        return $phrase;
    }

    /**
     * {@inheritDoc}
     */
    public function isAbbreviated(string $word): bool
    {
        return in_array(strtolower($word), self::ABBREVIATIONS, true);
    }
}
