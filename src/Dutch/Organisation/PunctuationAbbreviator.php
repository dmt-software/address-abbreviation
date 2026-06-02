<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Dutch\Organisation;

use DMT\Address\Abbreviation\AbbreviatorInterface;

final class PunctuationAbbreviator implements AbbreviatorInterface
{
    /** @var array<string, Closure> */
    private array $replaceCallbacks;

    public function __construct()
    {
        $this->replaceCallbacks = [
            '~(?<![\pL\pN])([A-Z])\.?([A-Z])\.(([A-Z])\.?)(?![\pL\pN])~iu'
                => fn(array $m) => rtrim(strtoupper($m[1] . $m[2] . $m[4])),
            '~((?<=\pL)\.)(?![\pL\pN])~i' => fn(array $m) => '',
        ];
    }

    /**
     * @inheritDoc
     */
    public function abbreviate(string $phrase): string
    {
        return preg_replace_callback_array($this->replaceCallbacks, $phrase);
    }
}
