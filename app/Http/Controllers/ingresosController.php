<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ingresosController extends Controller
{
    public function getShowIncomes(Request $request){


        // $token = $request->header("Authorization");
        // $replace = str_replace("Bearer ","",$token);


        // $decode_token = JWTAuth::setToken($replace)->authenticate();

        // $data = [

        //     "cedula" => $decode_token["cedula"],
        //     "nombre" => $decode_token["nombre"]
        // ];


        // //$getGroupLabors = modelSubLabores::getSubLaborsForId($id_labor);

        // if($getGroupLabors){


        //     $render = view("menuDashboard.myLabors", [ "token" => $decode_token, "sublabors" => $getGroupLabors])->render();

        //     return response()->json(["status" => true, "html" => $render, "token" => $decode_token]);

        // }

        // return response()->json(["status" => false, "message" => "No se pudó acceder a la base de datos para las sub labores!"]);

    }
}
