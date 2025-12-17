<?php

namespace DMT\Address\Abbreviation\General;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class AbbreviationGroupAbbreviator implements AbbreviatorInterface
{
    public function __construct(
        private array $abbreviators,
        private int $maxLength = 24,
        private bool $cumulative = false
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * Perform many abbreviations until the street is abbreviated enough or no abbreviations are left.
     */
    public function abbreviate(string $phrase): string
    {
        if (mb_strlen($phrase) <= $this->maxLength) {
            return $phrase;
        }

        foreach ($this->abbreviators as $abbreviator) {
            $abbreviatedAddress = $abbreviator->abbreviate($phrase);

            if (mb_strlen($abbreviatedAddress) <= $this->maxLength) {
                return $abbreviatedAddress;
            }

            if ($this->cumulative) {
                $phrase = $abbreviatedAddress;
            }
        }

        return $phrase;
    }
}