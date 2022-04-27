<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//estos dos comandos se utilizan para poder acceder a base de datos
//el segundo es para la respuesta
use DB;
use Response;

class envios extends Controller
{
   public function en()
   {
       echo "hola";
   }
}
