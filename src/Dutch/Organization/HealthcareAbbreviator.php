<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organization;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * Abbreviates Dutch healthcare and welfare organization names.
 *
 * This abbreviator handles common healthcare, welfare and care-related
 * organization terms, such as "Gezondheidscentrum", "Medisch Centrum",
 * "Geestelijke Gezondheidszorg" and "Maatschappelijke Dienstverlening".
 */
final class HealthcareAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(?<![\pL\pN])geestelijke gezondheidszorg(?![\pL\pN])~iu' => 'GGZ',
        '~(?<![\pL\pN])psychiatrie(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])psychiatrisch(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])psychiater(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])psychologie(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])psychologisch(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])psycholoog(?![\pL\pN])~iu' => 'Psych',
        '~(?<![\pL\pN])jeugdgezondheidszorg(?![\pL\pN])~iu' => 'JGZ',
        '~(?<![\pL\pN])gehandicaptenzorg(?![\pL\pN])~iu' => 'GHZ',
        '~(?<![\pL\pN])maatschappelijke dienstverlening(?![\pL\pN])~iu' => 'MD',
        '~(?<![\pL\pN])gezondheidscentrum(?![\pL\pN])~iu' => 'GC',
        '~(?<![\pL\pN])medisch centrum(?![\pL\pN])~iu' => 'MC',
        '~(?<![\pL\pN])zorgcentrum(?![\pL\pN])~iu' => 'ZC',
        '~(?<![\pL\pN])woonzorgcentrum(?![\pL\pN])~iu' => 'WZC',
        '~(?<![\pL\pN])(z)orggroep(?![\pL\pN])~iu' => '$1orggrp',
        '~(?<![\pL\pN])(h)uisartsenpraktijk(?![\pL\pN])~iu' => '$1ap',
        '~(?<![\pL\pN])(t)andartspraktijk(?![\pL\pN])~iu' => '$1ap',
        '~(?<![\pL\pN])(f)ysiotherapie(?![\pL\pN])~iu' => '$1ysio',
        '~(?<![\pL\pN])(a)potheek(?![\pL\pN])~iu' => '$1poth',
        '~(?<![\pL\pN])(v)erpleeghuis(?![\pL\pN])~iu' => '$1ph',
        '~(?<![\pL\pN])(t)huiszorg(?![\pL\pN])~iu' => '$1z',
        '~(?<![\pL\pN])(k)inderopvang(?![\pL\pN])~iu' => '$1o',
        '~(?<![\pL\pN])buitenschoolse opvang(?![\pL\pN])~iu' => 'BSO',
    ];

    private const array ABBREVIATIONS = [
        'ggz',
        'psych',
        'jgz',
        'ghz',
        'md',
        'gc',
        'mc',
        'zc',
        'wzc',
        'zorggrp',
        'hap',
        'tap',
        'fysio',
        'apoth',
        'vph',
        'tz',
        'welzorg',
        'ko',
        'bso',
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
