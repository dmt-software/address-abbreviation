<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Belgian\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class InvalidCharactersAbbreviator implements AbbreviatorInterface
{
    /**
     * @inheritDoc
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace('~[^\p{L}\d\-/ ]~u', '', $phrase);
    }
}
