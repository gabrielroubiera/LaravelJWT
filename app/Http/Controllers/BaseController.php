<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class BaseController extends Controller
{
    public function criticalError($messageError){
        return response($messageError, 500);
    }

    public function errorValidation($validationErrors){
        return response($validationErrors, 400);
    }

    public function unauthorized($message){
        return response($message, 401);
    }

    public function STATUSOK($message, $data){
        return response()->json(compact('message', 'data'), 200);
    }
}
