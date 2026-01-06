<?php

namespace DMT\Address\Abbreviation\Belgian\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class TitlesAbbreviator implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~(d)octor ~i' => '$1r. ',
        '~(d)octorandus ~i' => '$1rs. ',
        '~(i)ngenieur ~i' => '$1r. ',
        '~(m)eester ~i' => '$1r. ',
        '~(p)rofessor ~i' => '$1rof. ',
        '~(b)isschop ~i' => '$1p. ',
        '~(b)roeder ~i' => '$1r. ',
        '~(d)iaken ~i' => '$1kn. ',
        '~(d)eken ~i' => '$1ek. ',
        '~(d)ominee ~i' => '$1s. ',
        '~(k)anunnik ~i' => '$1an. ',
        '~(k)apelaan ~i' => '$1ap. ',
        '~(k)ardinaal ~i' => '$1ard. ',
        '~(p)astoo?r ~i' => '$1ast. ',
        '~(p)ater ~i' => '$1. ',
        '~(p)redikant ~i' => '$1red. ',
        '~(p)riester ~i' => '$1r. ',
        '~(s)int( |-)~i' => '$1t$2',
        '~(z)uster ~i' => '$1r. ',
        '~(lt|luitenant)(-| )generaal ~i' => 'Lt Gen. ',
        '~generaal ~i' => 'Gen. ',
        '~luitenant ~i' => 'Lt. ',
        '~kapitein ~i' => 'Kapt. ',
        '~(k|c)olonel ~i' => 'Col. ',
        '~majoor ~i' => 'Maj. ',
        '~(b)aron ~i' => '$1. ',
        '~(b)aronesse ~i' => '$1s. ',
        '~(j)onkheer ~i' => '$1h. ',
        '~(j)onkvrouw ~i' => '$1vr. ',
        '~(g)raaf ~i' => '$1. ',
        '~(g)ravin ~i' => '$1i. ',
        '~(h)ertog ~i' => '$1. ',
        '~(h)ertogin ~i' => '$1i. ',
        '~(k)eizer ~i' => '$1eiz. ',
        '~(k)oning ~i' => '$1on. ',
        '~(k)oningin ~i' => '$1onin. ',
        '~(p)rins ~i' => '$1r. ',
        '~(p)rinses ~i' => '$1s. ',
        '~(b)urgemeester ~i' => '$1urgem. ',
        '~(g)ouverneur ~i' => '$1ouv. ',
        '~(m)inister ~i' => '$1in. ',
        '~(h)eer ~i' => '$1r. ',
        '~(m)evrouw ~i' => '$1w. ',
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
     * Abbreviate the first two titles according to the replacements above.
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
        if ($word === 'Lt') {
            return true;
        }

        return preg_match('~^[a-z]+\.$~', $word) > 0;
    }
}