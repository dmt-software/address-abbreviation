<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Belgian\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class BoxAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~\b(boite|boîte)~ui' => 'bte',
        '~\b(box)~i' => 'box',
        '~\b(bte)~i' => 'bte',
        '~\b(bus)~i' => 'bus',
        '~^([^- ]+[ -])(box|bus|bte)(\b|\s)?([a-z0-9]+)~' => "$1$2 $4",
    ];

    /**
     * @inheritDoc
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $phrase = preg_replace($regex, $replacement, $phrase);
        }

        return $phrase;
    }
}
