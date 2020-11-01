<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseHelper extends Controller
{
    //
    private static $response = [
        'meta' => [
            'code' => 200,
            'message' => "success",
            'version' => '1.0'
        ],
        'results' => null,
    ];

    public static function response($code = 200, $data = null, $message = null) {


        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['results'] = $data;

        return response()->json(self::$response, $code);

    }
}
