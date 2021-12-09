<?php

namespace App\Casts\Digits;

use App\Traits\PersianDigitsConverterTrait;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PersianDigitCast implements CastsAttributes
{
    use PersianDigitsConverterTrait;

    public function get($model, string $key, $value, array $attributes)
    {
        return $this->convertDigitsToPersian($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
