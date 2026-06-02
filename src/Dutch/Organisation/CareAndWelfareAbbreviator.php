<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class CareAndWelfareAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])Buitenschoolse\s+Opvang(?![\pL\pN])~iu' => 'BSO',
        '~(?<![\pL\pN])Huisartsen(praktijk|post)(?![\pL\pN])~iu' => 'HAP',
        '~(?<![\pL\pN])Huisarts(en)?(?![\pL\pN])~iu' => 'HA',
        '~(?<![\pL\pN])Kinderopvang(?![\pL\pN])~iu' => 'KO',
        '~(F)ysiotherapie(?![\pL\pN])~iu' => '$1ysio',
        '~(?<![\pL\pN])(A)potheek(?![\pL\pN])~iu' => '$1poth',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}
