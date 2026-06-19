<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class TermAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~\b(begane grond|bg)\b~i' => 'BG',
        '~\b(sous|souterrain)\b~i' => 'O',
        '~\b(huis|hs)\b~i' => 'H',
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
