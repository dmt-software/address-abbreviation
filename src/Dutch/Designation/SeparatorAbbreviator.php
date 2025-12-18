<?php

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class SeparatorAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~((?<!^)[^A-Z0-9 ]{1,})~i' => ' ',
        '~([ ]{2,})~i' => ' ',
        '~^([A-Z])([^A-Z0-9 ](?=[A-Z0-9]))~i' => '$1 ',
        '~^([0-9]+)([^A-Z0-9\-](?=[0-9]))~i' => '$1-',
        '~^([0-9]+)([A-Z])~i' => '$1 $2',
        '~^([A-Z])([0-9])~i' => '$1 $2',
    ];

    /**
     * {@inheritDoc}
     *
     * Removes unnecessary separators and replaces (or adds) a valid separator.
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $phrase = preg_replace($regex, $replacement, $phrase);
        }

        return trim($phrase, ' ');
    }
}