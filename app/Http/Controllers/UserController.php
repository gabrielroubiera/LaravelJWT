<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\BaseController as Controller;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return $this->errorValidation($validator->errors());
        }

        //? Validate Login
        try {
            if(! $token = JWTAuth::attempt($credentials)){
                return $this->errorValidation("Invalid credentials.");
            }
        } catch(JWTException $e){
            return $this->criticalError("Could not create a token.");
        }

        return $this->STATUSOK("Haz iniciado session correctamente.", $token);

    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if($validator->fails()){
            return $this->errorValidation($validator->errors());
        }

        //? Create new user
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        //? Create token
        $token = JWTAuth::fromUser($user);

        return $this->STATUSOK('El usuario se ha creado correctamente.', $token);
    }
}
