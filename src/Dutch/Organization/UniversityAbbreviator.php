<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch university names.
 *
 * This abbreviator handles specific Dutch universities before a generic
 * education abbreviator can shorten terms such as "universiteit".
 */
final class UniversityAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])universiteit utrecht(?![\pL\pN])~iu' => 'UU',
        '~(?<![\pL\pN])universiteit leiden(?![\pL\pN])~iu' => 'LEI',
        '~(?<![\pL\pN])erasmus universiteit rotterdam(?![\pL\pN])~iu' => 'EUR',
        '~(?<![\pL\pN])radboud universiteit(?![\pL\pN])~iu' => 'RU',
        '~(?<![\pL\pN])open universiteit(?![\pL\pN])~iu' => 'OU',
        '~(?<![\pL\pN])universiteit van amsterdam(?![\pL\pN])~iu' => 'UvA',
        '~(?<![\pL\pN])vrije universiteit amsterdam(?![\pL\pN])~iu' => 'VU',
        '~(?<![\pL\pN])rijksuniversiteit groningen(?![\pL\pN])~iu' => 'RUG',
        '~(?<![\pL\pN])technische universiteit eindhoven(?![\pL\pN])~iu' => 'TU/e',
        '~(?<![\pL\pN])technische universiteit delft(?![\pL\pN])~iu' => 'TUD',
        '~(?<![\pL\pN])universiteit twente(?![\pL\pN])~iu' => 'UT',
        '~(?<![\pL\pN])tilburg university(?![\pL\pN])~iu' => 'TiU',
        '~(?<![\pL\pN])wageningen university & research(?![\pL\pN])~iu' => 'WUR',
        '~(?<![\pL\pN])wageningen university and research(?![\pL\pN])~iu' => 'WUR',
    ];

    private const array ABBREVIATIONS = [
        'uu',
        'lei',
        'ul',
        'eur',
        'ru',
        'ou',
        'uva',
        'vu',
        'rug',
        'tu/e',
        'tud',
        'ut',
        'tiu',
        'wur',
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
