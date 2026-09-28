<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch school and education-related organization names.
 *
 * This abbreviator handles common education types and institutional names,
 * such as "Openbare Basisschool", "Integraal Kindcentrum",
 * "Scholengemeenschap", "Hogeschool" and "Universiteit".
 */
final class EducationAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])protestants( |-)christelijke basisschool(?![\pL\pN])~iu' => 'PCBS',
        '~(?<![\pL\pN])rooms( |-)katholieke basisschool(?![\pL\pN])~iu' => 'RKBS',
        '~(?<![\pL\pN])openbare basisschool(?![\pL\pN])~iu' => 'OBS',
        '~(?<![\pL\pN])christelijke basisschool(?![\pL\pN])~iu' => 'CBS',
        '~(?<![\pL\pN])integraal kindcentrum(?![\pL\pN])~iu' => 'IKC',
        '~(?<![\pL\pN])kindcentrum(?![\pL\pN])~iu' => 'KC',
        '~(?<![\pL\pN])basisschool(?![\pL\pN])~iu' => 'BS',
        '~(?<![\pL\pN])scholengemeenschap(?![\pL\pN])~iu' => 'SG',
        '~(?<![\pL\pN])voortgezet onderwijs(?![\pL\pN])~iu' => 'VO',
        '~(?<![\pL\pN])middelbaar beroepsonderwijs(?![\pL\pN])~iu' => 'MBO',
        '~(?<![\pL\pN])hoger beroepsonderwijs(?![\pL\pN])~iu' => 'HBO',
        '~(?<![\pL\pN])hogeschool(?![\pL\pN])~iu' => 'HS',
        '~(?<![\pL\pN])lyceum(?![\pL\pN])~iu' => 'Lyc',
        '~(?<![\pL\pN])gymnasium(?![\pL\pN])~iu' => 'Gym',
    ];

    private const array ABBREVIATIONS = [
        'pcbs',
        'rkbs',
        'obs',
        'cbs',
        'ikc',
        'kc',
        'bs',
        'sg',
        'vo',
        'mbo',
        'hbo',
        'hs',
        'lyc',
        'gym',
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
