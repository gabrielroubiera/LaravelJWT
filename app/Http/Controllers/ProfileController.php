<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

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
}
