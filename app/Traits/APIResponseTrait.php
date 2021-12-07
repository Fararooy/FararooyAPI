<?php

namespace App\Traits;

trait APIResponseTrait
{
    protected function generateAPIResponse($status, $data, $errors, $code)
    {
        return response([
            'status' => $status,
            'data' => $data,
            'error' => $errors
        ], $code)->header('Content-type', 'application/json');
    }
}
