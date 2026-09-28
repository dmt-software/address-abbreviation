<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch prepositions and connecting words in organization names.
 *
 * This abbreviator shortens words and phrases such as "van", "van de",
 * "voor", "aan de".
 */
final class PrepositionAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<=.)\bvan de(r|n|)(?![\pL\pN])~iu' => 'vd',
        '~(?<=.)\bvan het(?![\pL\pN])~iu' => 'vh',
        '~(?<=.)\baan den?(?![\pL\pN])~iu' => 'ad',
        '~(?<=.)\baan het(?![\pL\pN])~iu' => 'ah',
        '~(?<=.)\bachter den?(?![\pL\pN])~iu' => 'ad',
        '~(?<=.)\bachter het(?![\pL\pN])~iu' => 'ah',
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
        return in_array(strtolower($word), ['vd', 'vh', 'ad', 'ah'], true);
    }
}
