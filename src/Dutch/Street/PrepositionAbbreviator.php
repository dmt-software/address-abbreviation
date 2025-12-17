<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class PrepositionAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~%s(d)e van de(r|)\b~i' => '$1vd',
        '~%s(a)an de\b~i' => '$1d',
        '~%s(a)chter de(n|)\b~i' => '$1d',
        '~%s(v)an de(r|n|)\b~i' => '$1d',
        '~%s(a)chter het\b~i' => '$1h',
        '~%s(v)an\b~i' => '$1',
    ];

    private array $lookup;
    private array $replace;

    public function __construct(bool $matchInsideOnly = false)
    {
        $this->lookup = array_map(
            fn(string $pattern)  => sprintf($pattern, $matchInsideOnly ? '(?<=.)\b' : '\b'),
            array_keys(self::REPLACEMENTS)
        );
        $this->replace = array_values(self::REPLACEMENTS);
    }

    /**
     * {@inheritDoc}
     *
     * Abbreviate some preposition with articles.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace($this->lookup, $this->replace, $phrase);
    }

    /**
     * @inheritDoc
     */
    public function isAbbreviated(string $word): bool
    {
        return in_array(mb_strtolower($word), ['ad', 'ah', 'dvd', 'vd', 'v']);
    }
}