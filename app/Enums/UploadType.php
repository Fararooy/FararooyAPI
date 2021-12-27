<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class UploadType extends Enum
{
    public const PROFILE_IMAGE = 'profile_image';
    public const EVENT_IMAGE = 'event_image';
}
