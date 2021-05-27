<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;

class DataController extends Controller
{
    public function open(){
        $data = "This route is open for everyone.";
        return $this->STATUSOK("La petición se ha completado con exito.", $data);
    }

    public function closed(){
        $data = "Your are here because you are logged.";
        return $this->STATUSOK("La petición se ha completado con exito.", $data);
    }
}
