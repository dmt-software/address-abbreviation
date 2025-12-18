<?php

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class TermAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~(begane grond|bg)~i' => 'BG',
        '~(sous|souterrain)~i' => 'O',
        '~(huis|hs)~i' => 'H',
    ];

    /**
     * {@inheritDoc}
     *
     * Abbreviate some terms with their abbreviation form.
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $phrase = preg_replace($regex, $replacement, $phrase);
        }

        return $phrase;
    }
}