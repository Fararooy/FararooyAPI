<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class APIResponseStatus extends Enum
{
    public const FAILURE = 'failure';
    public const SUCCESS = 'success';
}
