<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class LegalFormAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])B\s*\.?\s*V\s*\.?(?![\pL\pN])~iu' => 'BV',
        '~(?<![\pL\pN])N\s*\.?\s*V\s*\.?(?![\pL\pN])~iu' => 'NV',
        '~(?<![\pL\pN])V\s*\.?\s*O\s*\.\s*F\s*\.?(?![\pL\pN])~iu' => 'VOF',
        '~(?<![\pL\pN])C\s*\.?\s*V\s*\.?(?![\pL\pN])~iu' => 'CV',
        '~(?<![\pL\pN])(M)aatschap(pelijke?)(?![\pL\pN])~iu' => '$1ts',
        '~(?<![\pL\pN])(C)o[oö]peratie(ve)(?![\pL\pN])~iu' => '$1oop',
        '~(?<![\pL\pN])(S)tichting(?![\pL\pN])~iu' => '$1t',
        '~(?<![\pL\pN])(V)ereniging(?![\pL\pN])~iu' => '$1er',
    ];

    /**
     * @param array<string, string> $replacements
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}