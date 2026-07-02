<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

/**
 * NOTE:
 *
 * This abbreviator conflicts with the AdditionAbbreviator when used cumulative in case the addition consists of a
 * single letter. Set the forceReplacement to false if the AdditionAbbreviator is preferred over this abbreviator.
 *
 * It is only known it is a Roman numeral in single letter cases by validating surrounding addresses.
 */
class RomanNumeralAbbreviator implements AbbreviatorInterface
{
    public function __construct(private bool $forceReplacement = true)
    {
    }

    /**
     * {@inheritDoc}
     *
     * Replace a Roman numeral with its Arabic equivalent.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace_callback(
            '~^\d+[\P{L} ]?\K(?=[XVI])X?(I[XV]|V?I{0,3})(?![XVI])\b(?![\P{L} ]\d{1,3}$)~',
            function (array $match): string {
                $previous = 0;
                $values = [
                    'X' => 10,
                    'V' => 5,
                    'I' => 1,
                ];

                if (!$this->forceReplacement && strlen($match[0]) == 1) {
                    return $match[0];
                }

                $chars = array_reverse(str_split($match[0]));

                foreach ($chars as &$value) {
                    $current = $values[$value];
                    $value = $current < $previous ? -$current : $current;
                    $previous = $current;
                }

                return (string) array_sum($chars) ?: '';
            },
            $phrase
        );
    }
}
