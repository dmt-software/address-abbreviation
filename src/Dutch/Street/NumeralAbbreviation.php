<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviationCheckerInterface;
use DMT\Address\Abbreviation\AbbreviatorInterface;

final class NumeralAbbreviation implements AbbreviatorInterface, AbbreviationCheckerInterface
{
    private const array REPLACEMENTS = [
        '~\b(een|(?-i)I(?i))\b~i' => '1',
        '~\beerste\b~i' => '1e',
        '~\b(twee|(?-i)II(?i))(de)?\b~iu' => '2',
        '~\b(drie|(?-i)III(?i))\b~iu' => '3',
        '~\bderde\b~i' => '3e',
        '~\b(vier|(?-i)IV(?i))(de)?\b~i' => '4',
        '~\b(vijf|(?-i)V(?i))(de)?\b~i' => '5',
        '~\b(zes|(?-i)VI(?i))(de)?\b~i' => '6',
        '~\b(zeven|(?-i)VII(?i))(de)?\b~i' => '7',
        '~\b(acht|(?-i)VIII(?i))(ste)?\b~i' => '8',
        '~\b(negen|(?-i)IX(?i))(de)?\b~i' => '9',
        '~\b(tien|(?-i)X(?i))(de)?\b~i' => '10',
        '~\b(elf|(?-i)XI(?i))(de)?\b~i' => '11',
        '~\b(twaalf|(?-i)XII(?i))(de)?\b~i' => '12',
        '~\b(dertien|(?-i)XIII(?i))(de)?\b~i' => '13',
        '~\b(veertien|(?-i)XIV(?i))(de)?\b~i' => '14',
        '~\b(vijftien|(?-i)XV(?i))(de)?\b~i' => '15',
        '~\b(zestien|(?-i)XVI(?i))(de)?\b~i' => '16',
        '~\b(zeventien|(?-i)XVII(?i))(de)?\b~i' => '17',
        '~\b(achttien|(?-i)XVIII(?i))(de)?\b~i' => '18',
        '~\b(negentien|(?-i)XIX(?i))(de)?\b~i' => '19',
        '~\b(twintig|(?-i)XX(?i))(ste)?\b~i' => '20',
        '~\b(eenentwintig|(?-i)XXI(?i))(ste)?\b~i' => '21',
        '~\b(tweeëntwintig|(?-i)XXII(?i))(ste)?\b~i' => '22',
        '~\b(drieëntwintig|(?-i)XXIII(?i))(ste)?\b~i' => '23',
        '~\b(vierentwintig|(?-i)XXIV(?i))(ste)?\b~i' => '24',
        '~\b(vijfentwintig|(?-i)XXV(?i))(ste)?\b~i' => '25',
    ];

    /** @var array<string, callable> */
    private array $replacements;

    public function __construct()
    {
        $this->replacements = array_map(
            fn($number) => fn(array $match) => $number . (isset($match[2]) ? 'e' : ''),
            self::REPLACEMENTS
        );
    }

    /**
     * {@inheritDoc}
     *
     * 1. Replace written numerals (one till twenty-five) with their numeric equivalents.
     * 2. Replace Roman numerals (one till twenty-five) with their numeric equivalents.
     * 3. Replace ordinals (first till twenty-fifth) with their numeric followed by an 'e'.
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
        return !!preg_match('~^[1-9]~', $word);
    }
}