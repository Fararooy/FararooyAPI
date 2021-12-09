<?php

namespace App\Traits;

trait PersianDigitsConverterTrait
{
    public function convertDigitsToPersian(string $text): string
    {
        return $this->replaceWithPersianDigits($text);
    }

    private function replaceWithPersianDigits(string $text): string
    {
        return strtr($text, config('digits'));
    }
}
