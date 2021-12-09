<?php

namespace App\Casts\DateTime;

use App\Traits\PersianDigitsConverterTrait;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Morilog\Jalali\Jalalian;

class JalaliShortDateCast implements CastsAttributes
{
    use PersianDigitsConverterTrait;

    public function get($model, string $key, $value, array $attributes)
    {
        return $this->convertDigitsToPersian(
            Jalalian::fromFormat(config('formats.short_date.storage_format.jalali'), $value)
                ->format(config('formats.short_date.display_format.jalali'))
        );
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
