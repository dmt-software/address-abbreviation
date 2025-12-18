<?php

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class BAGStandardAbbreviator implements AbbreviatorInterface
{
    /**
     * {@inheritDoc}
     *
     * If the first part of the designation is a valid BAG standard abbreviation, return that part.
     */
    public function abbreviate(string $phrase): string
    {
        $match = [];
        if (preg_match('~^(([A-Z]|1[0-9]{,4})([ \-][A-Z0-9 ])?)\b~', $phrase, $match)) {
            return $match[1];
        }

        return $phrase;
    }
}