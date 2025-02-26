<?php

namespace App\Helper;

class ResponseHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function Success($status = 'success', $message = null, $data = [], $statusCode = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'statusCode' => $statusCode,
        ]);
    }

    public static function Error($status = 'error', $message = null, $statusCode = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'statusCode' => $statusCode,

        ]);
    }
}
