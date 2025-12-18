<?php

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class AdditionAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~^([^ \-]+[ \-])(rood|rd) ?([0-9]*)\b~i' => '$1RD$3',
        '~^([^ \-]+[ \-])(zwart|zw) ?([0-9]*)\b~i' => '$1ZW$3',
        '~^([^ \-]+[ \-])(bis|bs) ?([0-9]*)\b~i' => '$1BS$3',
        '~^([^ \-]+[ \-])([A-Z]) ?(bis|bs)\b~i' => '$1$2BIS',
        '~^([^ \-]+[ \-])([0-9]{1,2}) ?(bis|bs)\b~i' => '$1$2BS',
        '~^([^ \-]+[ \-])([A-Z]) ?([0-9]{,3})\b~i' => '$1$2$3',
    ];

    /**
     * {@inheritDoc}
     *
     * Abbreviate known additions according to the BAG standard.
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $phrase = preg_replace($regex, $replacement, $phrase);
        }

        return $phrase;
    }
}