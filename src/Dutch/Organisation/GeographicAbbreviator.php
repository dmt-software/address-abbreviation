<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class GeographicAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])Nederlandse?(?![\pL\pN])~iu' => 'Ned',
        '~(?<![\pL\pN])Nederland(?![\pL\pN])~iu' => 'NL',
        '~(?<![\pL\pN])(I)nternationaa?le?(?![\pL\pN])~iu' => '$1ntl',
        '~(?<![\pL\pN])(N)ationaa?le?(?![\pL\pN])~iu' => '$1at',
        '~(?<![\pL\pN])(R)egionaa?le?(?![\pL\pN])~iu' => '$1eg',
        '~(?<![\pL\pN])(C)entraa?le?(?![\pL\pN])~iu' => '$1entr',
        '~(?<![\pL\pN])(C)entrum(?![\pL\pN])~iu' => '$1tr',
        '~(?<![\pL\pN])Amsterdam(?![\pL\pN])~iu' => 'Adam',
        '~(?<![\pL\pN])Rotterdam(?![\pL\pN])~iu' => 'Rdam',
        '~(?<![\pL\pN])Utrecht(?![\pL\pN])~iu' => 'Utr',
        '~(?<![\pL\pN])Den\s+Haag(?![\pL\pN])~iu' => 'DH',
        '~(?<![\pL\pN])(N)oord(?![\pL\pN])~iu' => '$1',
        '~(?<![\pL\pN])(Z)uid(?![\pL\pN])~iu' => '$1',
        '~(?<![\pL\pN])(O)ost(?![\pL\pN])~iu' => '$1',
        '~(?<![\pL\pN])(W)est(?![\pL\pN])~iu' => '$1',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}
