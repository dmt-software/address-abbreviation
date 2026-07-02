<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Designation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

class RomanNumeralAbbreviator implements AbbreviatorInterface
{
    /**
     * {@inheritDoc}
     *
     * Replace a Roman numeral with its Arabic equivalent.
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace_callback(
            '~\d+[\P{L} ]?\K(?=[XVI])X?(I[XV]|V?I{0,3})\b~',
            static function (array $match): string {
                $previous = 0;
                $values = [
                    'X' => 10,
                    'V' => 5,
                    'I' => 1,
                ];
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
