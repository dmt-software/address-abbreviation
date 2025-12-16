<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class DirectionalIndicationAbbreviation implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~\bnoord(zijde)?\b~i' => 'N',
        '~\boost(zijde)?\b~i' => 'O',
        '~\bzuid(zijde)?\b~i' => 'Z',
        '~\bwest(zijde)?\b~i' => 'W',
    ];

    /** @var array<string, callable> */
    private array $replacements;

    public function __construct()
    {
        $this->replacements = array_map(
            fn($direction) => fn(array $match) => $direction . (isset($match[1]) ? 'z' : ''),
            self::REPLACEMENTS
        );
    }

    /**
     * {@inheritDoc}
     *
     * Abbreviate directional indications like North and South or Eastside or Westside.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace_callback_array($this->replacements, $phrase);
    }

    /**
     * @inheritDoc
     */
    public function isAbbreviated(string $word): bool
    {
        return !!preg_match('~(N|O|Z|W)z?$~', $word);
    }
}