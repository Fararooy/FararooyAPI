<?php

namespace App\Services;

use App\Enums\UploadType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadService
{
    public function uploadProfileImage(Request $request): string
    {
        $newFileName = $this->generateProfileImageName($request);
        $path = $this->getProfileImageUploadPath();
        $request->file('profile_image')->move(public_path() . '/' . $path, $newFileName);
        return env('APP_URL') . '/' . $path . '/' . $newFileName;
    }

    public function uploadEventImage(Request $request)
    {

    }

    private function generateProfileImageName(Request $request): string
    {
        return auth()->user()->id . '_' . Str::random(64) . '.' . $request->file('profile_image')->extension();
    }

    private function getProfileImageUploadPath(): string
    {
        return config('upload.' . UploadType::PROFILE_IMAGE . '.upload_path');
    }
}
