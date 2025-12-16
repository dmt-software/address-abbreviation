<?php

namespace DMT\Address\Abbreviation;

interface AbbreviationCheckerInterface
{
    /**
     * Test if a single word is abbreviated.
     */
    public function isAbbreviated(string $word): bool;
}
