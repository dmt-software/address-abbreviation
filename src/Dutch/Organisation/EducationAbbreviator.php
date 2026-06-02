<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class EducationAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?<![\pL\pN])Openbare\s+Basisschool(?![\pL\pN])~iu' => 'OBS',
        '~(?<![\pL\pN])Integraal\s+Kindcentrum(?![\pL\pN])~iu' => 'IKC',
        '~(?<![\pL\pN])Voortgezet\s+Onderwijs(?![\pL\pN])~iu' => 'VO',
        '~(?<![\pL\pN])Middelbaar\s+Beroepsonderwijs(?![\pL\pN])~iu' => 'MBO',
        '~(?<![\pL\pN])Hoger\s+Beroepsonderwijs(?![\pL\pN])~iu' => 'HBO',
        '~(?<![\pL\pN])Scholengemeenschap(?![\pL\pN])~iu' => 'SG',
        '~(?<![\pL\pN])Basisschool(?![\pL\pN])~iu' => 'BS',
        '~(?<![\pL\pN])Kindcentrum(?![\pL\pN])~iu' => 'KC',
        '~(?<![\pL\pN])Hogeschool(?![\pL\pN])~iu' => 'HS',
        '~(?<![\pL\pN])(U)niversiteit(?![\pL\pN])~iu' => '$1ni',
        '~(?<![\pL\pN])(G)ymnasium(?![\pL\pN])~iu' => '$1ym',
        '~(?<![\pL\pN])(L)yceum(?![\pL\pN])~iu' => '$1yc',
        '~(?<![\pL\pN])(C)ollege(?![\pL\pN])~iu' => '$1oll',
        '~Universiteit\s+van\s+Amsterdam(?![\pL\pN])~iu' => 'UVA',
        '~Universiteit\s+Utrecht(?![\pL\pN])~iu' => 'UU',
        '~Vrije\s+Universiteit(\s+Amsterdam)(?![\pL\pN])~iu' => 'VU',
        '~(Rijks)universiteit\s+Groningen)(?![\pL\pN])~iu' => 'RUG',
        '~(Erasmus\s+)Universiteit\s+Rotterdam)(?![\pL\pN])~iu' => 'EUR',
        '~Universiteit\s+Twente(?![\pL\pN])~iu' => 'UT',
        '~Technische\s+Universiteit\s+Delft~iu' => 'TU Delft',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}