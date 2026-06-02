<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class LegalFormAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])(M)aatschap(pelijke)(?![\pL\pN])~iu' => '$1ts',
        '~(?<![\pL\pN])(C)o[oö]peratie(ve)(?![\pL\pN])~iu' => '$1oop',
        '~(?<![\pL\pN])(S)tichting(?![\pL\pN])~iu' => '$1t',
        '~(?<![\pL\pN])(V)ereniging(?![\pL\pN])~iu' => '$1er',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}
