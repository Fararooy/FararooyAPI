<?php

use App\Enums\UploadType;

return [

    UploadType::PROFILE_IMAGE => [
        'upload_path' => 'uploads/users/profile_images',
    ],

    UploadType::EVENT_IMAGE => [
        'upload_path' => 'uploads/events/images',
    ],

];
