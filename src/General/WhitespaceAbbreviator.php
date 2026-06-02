<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\General;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class WhitespaceAbbreviator implements AbbreviatorInterface
{
    /**
     * {@inheritDoc}
     *
     * Trims white space from the beginning and end of the phrase and replaces double spaces with a single one.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace('~ {2,}~', ' ', trim($phrase));
    }
}
