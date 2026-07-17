<?php

declare(strict_types=1);

namespace DMT\Address\Abbreviation\Belgian\Designation;

use Closure;
use DMT\Address\Abbreviation\AbbreviatorInterface;

class AdditionAbbreviator implements AbbreviatorInterface
{
    /** @var array<string, Closure> */
    private array $replaceCallbacks;

    public function __construct()
    {
        $this->replaceCallbacks = [
            '~^(\d+)\s*([\-/])\s*(\d+)~' => fn(array $m) => $m[1] . $m[2] . $m[3],
            '~^(\d+)\s*([A-Z])\b~i' => fn(array $m) => $m[1] . strtoupper($m[2] ?? ''),
            '~^(\d+)\s*(bis)(\s?([0-9A-Z]))?\b~i' => fn(array $m) => $m[1] . ' ' . $m[2] . strtoupper($m[4] ?? ''),
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
