<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch legal forms in organization names.
 *
 * This abbreviator handles full legal-form descriptions, such as
 * "besloten vennootschap", "naamloze vennootschap", "stichting" and
 * "maatschap". Existing dotted notations such as "B.V." or "N.V." are
 * intentionally handled by a separate notation abbreviator.
 */
final class LegalFormAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])besloten vennootschap(?![\pL\pN])~iu' => 'BV',
        '~(?<![\pL\pN])naamloze vennootschap(?![\pL\pN])~iu' => 'NV',
        '~(?<![\pL\pN])vennootschap onder firma(?![\pL\pN])~iu' => 'VOF',
        '~(?<![\pL\pN])commanditaire vennootschap(?![\pL\pN])~iu' => 'CV',
        '~(?<![\pL\pN])co(o|ö)peratie(?![\pL\pN])~iu' => 'Coop',
        '~(?<![\pL\pN])maatschap(?![\pL\pN])~iu' => 'Mts',
        '~(?<![\pL\pN])stichting(?![\pL\pN])~iu' => 'Stg',
    ];

    private const array ABBREVIATIONS = [
        'bv',
        'nv',
        'vof',
        'cv',
        'coop',
        'emz',
        'mts',
        'stg',
        'ver',
    ];

    /**
     * {@inheritDoc}
     *
     * Abbreviate Dutch legal forms used in organization names.
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
