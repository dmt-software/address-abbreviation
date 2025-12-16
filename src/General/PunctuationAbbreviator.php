<?php

namespace DMT\Address\Abbreviation\General;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class PunctuationAbbreviator implements AbbreviatorInterface
{
    /**
     * {@inheritDoc}
     *
     * Trims and replaces all "." with a space and afterward all double spaces with a single space.
     */
    public function abbreviate(string $phrase): string
    {
        return trim(preg_replace(['~\.~', '~ {2,}~'], ' ', trim($phrase)));
    }
}
