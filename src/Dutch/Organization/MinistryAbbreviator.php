<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch ministry names.
 *
 * This abbreviator handles full names of Dutch ministries, such as
 * "Ministerie van Algemene Zaken", "Ministerie van Infrastructuur en
 * Waterstaat" and "Ministerie van Volksgezondheid, Welzijn en Sport".
 */
final class MinistryAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])(ministerie van) algemene zaken(?![\pL\pN])~iu' => '$1 AZ',
        '~(?<![\pL\pN])(ministerie van) binnenlandse zaken en koninkrijksrelaties(?![\pL\pN])~iu' => '$1 BZK',
        '~(?<![\pL\pN])(ministerie van) buitenlandse zaken(?![\pL\pN])~iu' => '$1 BZ',
        '~(?<![\pL\pN])(ministerie van) defensie(?![\pL\pN])~iu' => '$1 Defensie',
        '~(?<![\pL\pN])(ministerie van) economische zaken en klimaat(?![\pL\pN])~iu' => '$1 EZK',
        '~(?<![\pL\pN])(ministerie van) economische zaken(?![\pL\pN])~iu' => '$1 EZ',
        '~(?<![\pL\pN])(ministerie van) financi(ë|e)n(?![\pL\pN])~iu' => '$1 FIN',
        '~(?<![\pL\pN])(ministerie van) infrastructuur en waterstaat(?![\pL\pN])~iu' => '$1 IenW',
        '~(?<![\pL\pN])(ministerie van) justitie en veiligheid(?![\pL\pN])~iu' => '$1 JenV',
        '~(?<![\pL\pN])(ministerie van) landbouw,? visserij,? voedselzekerheid en natuur(?![\pL\pN])~iu' => '$1 LVVN',
        '~(?<![\pL\pN])(ministerie van) onderwijs,? cultuur en wetenschap(?![\pL\pN])~iu' => '$1 OCW',
        '~(?<![\pL\pN])(ministerie van) sociale zaken en werkgelegenheid(?![\pL\pN])~iu' => '$1 SZW',
        '~(?<![\pL\pN])(ministerie van) volksgezondheid,? welzijn en sport(?![\pL\pN])~iu' => '$1 VWS',
        '~(?<![\pL\pN])(ministerie van) volkshuisvesting en ruimtelijke ordening(?![\pL\pN])~iu' => '$1 VRO',
        '~(?<![\pL\pN])(ministerie van) volkshuisvesting,? ruimtelijke ordening en milieubeheer(?![\pL\pN])~iu'
            => '$1 VROM',
    ];

    private const array ABBREVIATIONS = [
        'az',
        'bzk',
        'bz',
        'defensie',
        'ezk',
        'ez',
        'fin',
        'ienw',
        'jenv',
        'lvvn',
        'ocw',
        'szw',
        'vws',
        'vro',
        'vrom',
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
