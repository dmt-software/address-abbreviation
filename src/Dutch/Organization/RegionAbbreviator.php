<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch region and scope indicators in organization names.
 *
 * This abbreviator handles words that describe geographical or organizational
 * scope, such as "Nederland", "Nederlandse", "Nationaal", "Regionaal",
 * "Noord", "Zuid", "Oost" and "West".
 */
final class RegionAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])nederlandse(?![\pL\pN])~iu' => 'Ned',
        '~(?<![\pL\pN])nederlands(?![\pL\pN])~iu' => 'Ned',
        '~(?<![\pL\pN])nederland(?![\pL\pN])~iu' => 'NL',
        '~(?<![\pL\pN])(i)nternationaal(?![\pL\pN])~iu' => '$1ntl',
        '~(?<![\pL\pN])(n)ationaal(?![\pL\pN])~iu' => '$1at',
        '~(?<![\pL\pN])(r)egionaal(?![\pL\pN])~iu' => '$1eg',
        '~(?<![\pL\pN])(c)entraal(?![\pL\pN])~iu' => '$1entr',
        '~(?<![\pL\pN])noord(?![\pL\pN])~iu' => 'N',
        '~(?<![\pL\pN])zuid(?![\pL\pN])~iu' => 'Z',
        '~(?<![\pL\pN])oost(?![\pL\pN])~iu' => 'O',
        '~(?<![\pL\pN])west(?![\pL\pN])~iu' => 'W',
    ];

    private const array ABBREVIATIONS = [
        'ned',
        'nl',
        'intl',
        'nat',
        'reg',
        'centr',
        'n',
        'z',
        'o',
        'w',
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
