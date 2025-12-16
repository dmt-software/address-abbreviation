<?php

namespace DMT\Address\Abbreviation\Dutch\Street;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class TypeNameAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(?=(\b|.))(b)oulevard(\b|$)~i' => '$2lvd',
        '~(?=(\b|.))(b)ungalowpark(\b|$)~i' => '$2glwprk',
        '~(?=(\b|.))(p)ark(\b|$)~i' => '$2rk',
        '~(?=(\b|.))(p)arkeerterrein(\b|$)~i' => '$2arkeerterr',
        '~(?=(\b|.))(d)reef(\b|$)~i' => '$2r',
        '~(?=(\b|.))(p)laats(\b|$)~i' => '$2lts',
        '~(?=(\b|.))(d)rift(\b|$)~i' => '$2r',
        '~(?=(\b|.))(p)lantsoen(\b|$)~i' => '$2lnts',
        '~(?=(\b|.))(d)warsstraat(\b|$)~i' => '$2wstr',
        '~(?=(\b|.))(p)lein(\b|$)~i' => '$2ln',
        '~(?=(\b|.))(d)warsweg(\b|$)~i' => '$2wwg',
        '~(?=(\b|.))(p)olderdijk(\b|$)~i' => '$2ldrdk',
        '~(?=(\b|.))(p)older(\b|$)~i' => '$2ldr',
        '~(?=(\b|.))(d)ijk(\b|$)~i' => '$2k',
        '~(?=(\b|.))(g)racht(\b|$)~i' => '$2r',
        '~(?=(\b|.))(p)olderweg(\b|$)~i' => '$2ldrwg',
        '~(?=(\b|.))(h)aven(\b|$)~i' => '$2vn',
        '~(?=(\b|.))(s)ingel(\b|$)~i' => '$2ngl',
        '~(?=(\b|.))(i)ndustrieterrein(\b|$)~i' => '$2ndustrieterr',
        '~(?=(\b|.))(s)teech(\b|$)~i' => '$2tg',
        '~(?=(\b|.))(k)ade(\b|$)~i' => '$2d',
        '~(?=(\b|.))(s)teeg(\b|$)~i' => '$2tg',
        '~(?=(\b|.))(k)anaal(\b|$)~i' => '$2an',
        '~(?=(\b|.))(s)traat(\b|$)~i' => '$2tr',
        '~(?=(\b|.))(l)aan(\b|$)~i' => '$2n',
        '~(?=(\b|.))(s)traatje(\b|$)~i' => '$2tr',
        '~(?=(\b|.))(l)aantje(\b|$)~i' => '$2n',
        '~(?=(\b|.))(s)traatweg(\b|$)~i' => '$2trwg',
        '~(?=(\b|.))(l)eane(\b|$)~i' => '$2n',
        '~(?=(\b|.))(s)trjitte(\b|$)~i' => '$2tr',
        '~(?=(\b|.))(l)oane(\b|$)~i' => '$2n',
        '~(?=(\b|.))(w)eg(\b|$)~i' => '$2g',
        '~(?=(\b|.))(p)ad(\b|$)~i' => '$2d',
        '~(?=(\b|.))(w)egje(\b|$)~i' => '$2g',
    ];

    private const array ABBREVIATIONS = [

    ];

    /** @var array<string, callable> */
    private array $replacements;

    public function __construct()
    {
        $this->replacements = array_map(
            fn($street) => function(array $match) use ($street) {
                $street = str_replace('$2', $match[2], $street);

                if (!empty($match[1])) {
                    $street = strtolower($street);
                }

                return $street;
            },
            self::REPLACEMENTS
        );
    }

    /**
     * {@inheritDoc}
     *
     * Replaces street types with their abbreviation form.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace_callback_array($this->replacements, $phrase);
    }
}