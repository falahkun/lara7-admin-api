<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper extends Controller
{
    private static $messages = [
        'required' => 'The :attribute is required please fill it',
        'email' => 'The :attribute is invalid',
        'unique' => ':attribute  Tidak boleh sama',
    ];
    public static function validating($request = null, $rules = null)
    {
        $vali = Validator::make($request, $rules, self::$messages);
        return $vali;
    }
}
