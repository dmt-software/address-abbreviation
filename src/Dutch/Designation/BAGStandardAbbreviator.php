<?php

declare(strict_types=1);

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
        $pattern = '~^([A-Z]|[1-9][0-9]{0,4})([ \-]([A-Z0-9 \-]{1,4}))?(\b|$)~i';
        if (preg_match($pattern, $phrase, $m)) {
            return trim($m[1] . ' ' . $m[3]);
        }

        return $phrase;
    }
}
