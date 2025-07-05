<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function jsonResponse($succes, $massage, $data, $statusCode) : JsonResponse {
        return response()->json([
            'success' => $succes,
            'massage' => $massage,
            'data' => $data,
        ], $statusCode);
    }
}