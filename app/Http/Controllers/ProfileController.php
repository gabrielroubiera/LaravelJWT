<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function me(){
        $user = auth()->user();
        return $this->STATUSOK("La Peticion se ha completado con exito.", $user);
    }

    public function editprofile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return $this->errorValidation($validator->errors());
        }
    }
}
