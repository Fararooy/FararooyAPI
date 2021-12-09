<?php

namespace App\Casts\DateTime;

use App\Traits\PersianDigitsConverterTrait;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Morilog\Jalali\Jalalian;
use function config;

class JalaliDateCast implements CastsAttributes
{
    use PersianDigitsConverterTrait;

    public function get($model, string $key, $value, array $attributes)
    {
        return $this->convertDigitsToPersian(
            Jalalian::fromFormat(config('formats.date.storage_format.jalali'), $value)
                ->format(config('formats.date.display_format.jalali'))
        );
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
