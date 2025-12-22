<?php

namespace DMT\Address\Abbreviation\Belgian\Street;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class TypeNameAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~\bavenue(?= )~i' =>  'Av.',
        '~\bboulevard(?= )~i' =>  'Bd',
        '~\bcenter(?= )~i' =>  'Ctre',
        '~\bplace(?= )~i' =>  'Pl.',
        '~\broute(?= )~i' =>  'Rte',
        '~\bsquare(?= )~i' =>  'Sq.',
        '~\bzone industrielle\b~i' => 'Z.I.',
        '~\bchauss(é|e)e(?= )~iu' =>  'Chée',
        '~\bimpasse(?= )~i' =>  'Imp.',
        '~(s)traat\b~i' => '$1tr.',
        '~(l)aan\b~i' => '$1n',
        '~(p)lein\b~i' => '$1l.',
        '~(s)teenweg\b~i' => '$1twg',
        '~\bindustriezone\b~i' => 'I.Z.',
        '~(g)ebouw\b~i' => '$1eb.',
        '~(?=[a-z\-])square\b~i' => 'sq',
        '~\bstra(ss|ß)e\b~iu' => 'Str.',
        '~(?!\b)stra(ss|ß)e\b~iu' => 'str.',
        '~\ballee\b~i' => 'All.',
        '~(?!\b)allee\b~i' => 'all.',
        '~\bplatz\b~i' => 'Pl.',
        '~(?!\b)platz\b~i' => 'pl.',
        '~\bgewerbegebiet\b~i' => 'GG.',
        '~\bresidenz\b~i' => 'Res.',
        '~(?!\b)residenz\b~i' => 'res.',
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
     * Abbreviate street types with their abbreviation form.
     *
     * Other street type abbreviations are not recommended.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace($this->lookup, $this->replace, $phrase);
    }
}
