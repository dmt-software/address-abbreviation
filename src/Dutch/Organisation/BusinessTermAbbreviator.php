<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final readonly class BusinessTermAbbreviator implements AbbreviatorInterface
{
    private const REPLACEMENTS = [
        '~(a)dministratie(?![\pL\pN])~iu' => '$1dm',
        '~(b)edrijf(?![\pL\pN])~iu' => '$1edr',
        '~(b)eheer(?![\pL\pN])~iu' => '$1eh',
        '~(b)ureau(?![\pL\pN])~iu' => '$1ur',
        '~(d)ienstverlening(?![\pL\pN])~iu' => '$1ienstverl',
        '~(d)ienst(en)(?![\pL\pN])~iu' => '$1nst',
        '~(g)(roep|roup)(?![\pL\pN])~iu' => '$1rp',
        '~(h)andel(?![\pL\pN])~iu' => '$1dl',
        '~(i)ndustrie(?![\pL\pN])~iu' => '$1nd',
        '~(k)antoor(?![\pL\pN])~iu' => '$1ant',
        '~(?<![\pL\pN])(A)utomatisering(?![\pL\pN])~iu' => '$1utom',
        '~(?<![\pL\pN])(V)erzekeringen(?![\pL\pN])~iu' => '$1erz',
        '~(?<![\pL\pN])(F)inanci(ële|eel)?(?![\pL\pN])~iu' => '$1in',
        '~(?<![\pL\pN])(M)akelaardij(?![\pL\pN])~iu' => '$1ld',
        '~(?<![\pL\pN])(T)ransport(?![\pL\pN])~iu' => '$1ransp',
        '~(?<![\pL\pN])(L)ogistiek(?![\pL\pN])~iu' => '$1og',
        '~(?<![\pL\pN])(M)arketing(?![\pL\pN])~iu' => '$1ktg',
        '~(?<![\pL\pN])(C)ommunicatie(?![\pL\pN])~iu' => '$1omm',
        '~(?<![\pL\pN])(R)eclame(?![\pL\pN])~iu' => '$1ecl',
        '~(?<![\pL\pN])(U)itgeverij(?![\pL\pN])~iu' => '$1itg',
        '~(?<![\pL\pN])(I)nternational(?![\pL\pN])~iu' => '$1ntl',
        '~(?<![\pL\pN])(P)artners(?![\pL\pN])~iu' => '$1ts',
    ];

    public function abbreviate(string $phrase): string
    {
        foreach (self::REPLACEMENTS as $expression => $replacement) {
            $phrase = preg_replace($expression, $replacement, $phrase);
        }

        return $phrase;
    }
}
