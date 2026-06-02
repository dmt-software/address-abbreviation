<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Belgian\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class RemoveRemarkAbbreviator implements AbbreviatorInterface
{
    private const array REPLACEMENTS = [
        '~((box|bus|bte)\s[a-z0-9]+)\b(.*)$~i' => '$1',
        '~(bis[A-Z0-9]?)\b(.*)$~' => '$1',
        '~(\d+([A-Z]|[\-/]\d+)?)\b(.*)$~i' => '$1',
        '~(\d+)\s.*$~' => '$1'
    ];

    /**
     * @inheritDoc
     */
    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $regex => $replacement) {
            $count = 0;
            $phrase = preg_replace($regex, $replacement, $phrase, count: $count);

            if ($count > 0) {
                break;
            }
        }

        return $phrase;
    }
}
