<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class InstitutionAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])Kamer\s+van\s+Koophandel(?![\pL\pN])~iu' => 'KvK',
        '~(?<![\pL\pN])Openbaar\s+Ministerie(?![\pL\pN])~iu' => 'OM',
        '~(?<![\pL\pN])Raad\s+van\s+State(?![\pL\pN])~iu' => 'RvS',
        '~(?<![\pL\pN])Belastingdienst(?![\pL\pN])~iu' => 'BD',
        '~(?<![\pL\pN])(M)inisterie(?![\pL\pN])~iu' => '$1in',
        '~(?<![\pL\pN])(G)emeente(?![\pL\pN])~iu' => '$1em',
        '~(?<![\pL\pN])(P)rovincie(?![\pL\pN])~iu' => '$1rov',
        '~(?<![\pL\pN])(W)aterschap(?![\pL\pN])~iu' => '$1S',
        '~(?<![\pL\pN])(R)echtbank(?![\pL\pN])~iu' => '$1b',
        '~(?<![\pL\pN])(O)rganisatie(?![\pL\pN])~iu' => '$1rg',
        '~(?<![\pL\pN])(I)nstelling(?![\pL\pN])~iu' => '$1nst',
        '~(?<![\pL\pN])(I)nstituut(?![\pL\pN])~iu' => '$1nst',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}
