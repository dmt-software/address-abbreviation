<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates generic Dutch organization terms.
 *
 * This abbreviator handles common descriptive words in organization names,
 * such as "bedrijf", "kantoor", "afdeling", "bureau" and "organisatie".
 * Specific legal forms, associations, schools and universities are handled
 * by separate abbreviators.
 */
final class OrganizationTermAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])(a)dministratie(?![\pL\pN])~iu' => '$1dm',
        '~(?<![\pL\pN])(a)fdeling(?![\pL\pN])~iu' => '$1fd',
        '~(?<![\pL\pN])(b)edrijf(?![\pL\pN])~iu' => '$1edr',
        '~(?<![\pL\pN])(b)ureau(?![\pL\pN])~iu' => '$1ur',
        '~(?<![\pL\pN])(c)entrum(?![\pL\pN])~iu' => '$1tr',
        '~(?<![\pL\pN])(d)ienst(?![\pL\pN])~iu' => '$1nst',
        '~(?<![\pL\pN])(d)irectie(?![\pL\pN])~iu' => '$1ir',
        '~(?<![\pL\pN])(d)ivisie(?![\pL\pN])~iu' => '$1iv',
        '~(?<![\pL\pN])(f)iliaal(?![\pL\pN])~iu' => '$1il',
        '~(?<![\pL\pN])(g)roep(?![\pL\pN])~iu' => '$1rp',
        '~(?<![\pL\pN])(i)nstelling(?![\pL\pN])~iu' => '$1nst',
        '~(?<![\pL\pN])(i)nstituut(?![\pL\pN])~iu' => '$1nst',
        '~(?<![\pL\pN])(k)antoor(?![\pL\pN])~iu' => '$1nt',
        '~(?<![\pL\pN])(l)ocatie(?![\pL\pN])~iu' => '$1oc',
        '~(?<![\pL\pN])(m)aatschappij(?![\pL\pN])~iu' => '$1ij',
        '~(?<![\pL\pN])(o)nderneming(?![\pL\pN])~iu' => '$1nd',
        '~(?<![\pL\pN])(o)rganisatie(?![\pL\pN])~iu' => '$1rg',
        '~(?<![\pL\pN])(p)raktijk(?![\pL\pN])~iu' => '$1rakt',
        '~(?<![\pL\pN])(s)ecretariaat(?![\pL\pN])~iu' => '$1ecr',
        '~(?<![\pL\pN])(s)ector(?![\pL\pN])~iu' => '$1ect',
        '~(?<![\pL\pN])(v)estiging(?![\pL\pN])~iu' => '$1est',
    ];

    private const array ABBREVIATIONS = [
        'adm',
        'afd',
        'bedr',
        'bur',
        'ctr',
        'dnst',
        'dir',
        'div',
        'fil',
        'grp',
        'inst',
        'knt',
        'loc',
        'mij',
        'ond',
        'org',
        'prakt',
        'secr',
        'sect',
        'vest',
    ];

    private array $lookup;
    private array $replace;

    public function __construct()
    {
        $this->lookup = array_keys(self::REPLACEMENTS);
        $this->replace = array_values(self::REPLACEMENTS);
    }

    /**
     * {@inheritDoc}
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace($this->lookup, $this->replace, $phrase);
    }

    /**
     * {@inheritDoc}
     */
    public function isAbbreviated(string $word): bool
    {
        return in_array(strtolower($word), self::ABBREVIATIONS, true);
    }
}
