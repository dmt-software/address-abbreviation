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
        $m = [];
        if (preg_match('~^(([A-Z]|[1-9][0-9]{0,4})([ \-](([0-9 ](?=\d|\b)){3,4}(?! )|([A-Z0-9]{1,4})))?)\b~i', $phrase, $m)) {
            return $m[1];
        }

        return $phrase;
    }
}