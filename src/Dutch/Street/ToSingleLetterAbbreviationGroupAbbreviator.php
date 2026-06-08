<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;
use DMT\Address\Abbreviation\General\AbbreviationGroupAbbreviator;

final readonly class ToSingleLetterAbbreviationGroupAbbreviator implements
    AbbreviatorInterface,
    AbbreviationCheckerInterface
{
    public function __construct(
        /** @var array<AbbreviatorInterface> */
        private array $abbreviators = [],
        private int $maxLength = 24,
        private true $cumulative = true
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * Abbreviates all words to a single letter unless the word is part of the street type name or already abbreviated.
     */
    public function abbreviate(string $phrase): string
    {
        // apply all abbreviators cumulative on the phrase.
        $phrase = (new AbbreviationGroupAbbreviator(...get_object_vars($this)))->abbreviate($phrase);

        $words = explode(' ', $phrase);
        $count = count($words);

        for ($i = 0; $i < $count - 1; $i++) {
            if (mb_strlen($phrase) <= $this->maxLength) {
                return $phrase;
            }

            $word = &$words[$i];
            $nextWord = $words[$i + 1] ?? '';

            $isStreet = '~^(kan|stg|kd|pldrkd|sngl|hvn|gr|plnts|plts|parkeerterr|industrieterr|blvd|pd|dr|pldr|'
                . 'dwwg|pldrwg|strwg|wg|dk|dwstr|str|ln|pln|bglwprk|prk)$~i';

            if (preg_match($isStreet, $word) || preg_match($isStreet, $nextWord) || $this->isAbbreviated($word)) {
                continue;
            }

            $word = preg_replace('~^((([a-z]\')?[a-z])|(\'[a-z][^a-z]?[a-z])|[a-z]).*$~i', '$1', $word);

            $phrase = implode(' ', $words);
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

        foreach ($this->abbreviators as $abbreviator) {
            if (!$abbreviator instanceof AbbreviationCheckerInterface) {
                continue;
            }

            if ($abbreviator->isAbbreviated($word)) {
                return true;
            }
        }

        return false;
    }
}
