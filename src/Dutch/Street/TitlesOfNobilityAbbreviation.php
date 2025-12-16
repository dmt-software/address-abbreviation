<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

class TitlesOfNobilityAbbreviation implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~^([^ ]+ )?aartshertog ~i' => '$1Aartsh ',
        '~^([^ ]+ )?jonkheer ~i' => '$1Jhr ',
        '~^([^ ]+ )?baronesse ~i' => '$1Bsse ',
        '~^([^ ]+ )?jonkvrouw ~i' => '$1Jkvr ',
        '~^([^ ]+ )?baron ~i' => '$1Bar ',
        '~^([^ ]+ )?keizer ~i' => '$1Kzr ',
        '~^([^ ]+ )?graaf ~i' => '$1Gr ',
        '~^([^ ]+ )?koningin ~i' => '$1Kon ',
        '~^([^ ]+ )?gravin ~i' => '$1Gv ',
        '~^([^ ]+ )?koning ~i' => '$1Kon ',
        '~^([^ ]+ )?hertogin ~i' => '$1Htgn ',
        '~^([^ ]+ )?prinses ~i' => '$1Pr ',
        '~^([^ ]+ )?hertog ~i' => '$1Htg ',
        '~^([^ ]+ )?prins ~i' => '$1Pr ',
        '~^([^ ]+ )?jonker ~i' => '$1Jkr ',
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
     * Abbreviate the first two noble titles according to the replacements above.
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
        return in_array($word, array_map(fn ($val) => trim($val, '1$ '), $this->replace));
    }
}