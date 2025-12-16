<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

class ToSingleLetterAbbreviation implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array STREET_ABBREVIATIONS = [
        '~^(.* )(\S*(?<=\w).?)(kan|stg|kd|sngl|hvn|gr|plnts|plts|parkeerterr|industrieterr|blvd|pd)\b~i',
        '~^(.* )(\S*(?<=\w).?)(pldr)?dk\b~i',
        '~^(.* )(\S*(?<=\w).?)(dw)?str\b~i',
        '~^(.* )(\S*(?<=\w).?)(dw|pldr|str)?wg\b~i',
        '~^(.* )(\S*(?<=\w).?)(p)?ln\b~i',
        '~^(.* )(\S*(?<=\w).?)(pl)?dr\b~i',
        '~^(.* )(\S*(?<=\w).?)(bglw)?prk\b~i',
    ];

    public function __construct(
        /** @var array<AbbreviationCheckerInterface> */
        private array $abbreviatorCheckers = [],
        private int $maxLength = 24,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * Abbreviates all words to a single letter unless the word is part of the street type name or already abbreviated.
     */
    public function abbreviate(string $phrase): string
    {
        $matches = [];
        foreach (self::STREET_ABBREVIATIONS as $pattern) {
            if (!preg_match($pattern, $phrase, $matches)) {
                continue;
            }

            $words = explode(' ', $matches[1]);

            foreach ($words as &$word) {
                if ($this->isAbbreviated($word)) {
                    continue;
                }

                $word = preg_replace('~^((([a-z]\')?[a-z])|(\'[a-z][^a-z]?[a-z])|[a-z]).*$~i', '$1', $word);
            }

            $phrase = str_replace($matches[1], implode(' ', $words), $phrase);

            if (mb_strlen($phrase) <= $this->maxLength) {
                return $phrase;
            }
        }

        return $phrase;
    }

    /**
     * @inheritDoc
     */
    public function isAbbreviated(string $word): bool
    {
        if (mb_strlen($word) == 1) {
            return true;
        }

        foreach ($this->abbreviatorCheckers as $abbreviationChecker) {
            if ($abbreviationChecker->isAbbreviated($word)) {
                return true;
            }
        }

        return false;
    }
}