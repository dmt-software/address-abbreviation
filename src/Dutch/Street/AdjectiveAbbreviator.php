<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class AdjectiveAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~^gedempte\b~i' => 'Ged',
        '~^noordelijk(e)\b~i' => 'Noordel',
        '~^groo?te?\b~i' => 'Grt',
        '~^oostelijke?\b~i' => 'Oostel',
        '~^oude\b~i' => 'Ou',
        '~^hoge\b~i' => 'Hg',
        '~^verlengde\b~i' => 'Verl',
        '~^kleine\b~i' => 'Kl',
        '~^voormalig(e)\b~i' => 'Voorm',
        '~^kromme\b~i' => 'Kr',
        '~^westelijk(e)\b~i' => 'Westel',
        '~^lieve\b~i' => 'Lv',
        '~^zuidelijke?\b~i' => 'Zuidel',
        '~^nieuwe?\b~i' => 'Nw',
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
     *
     * Shorten adjectives within the street name.
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
        return in_array($word, $this->replace);
    }
}