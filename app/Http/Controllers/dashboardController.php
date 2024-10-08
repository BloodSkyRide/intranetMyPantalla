<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\labores;
use App\Models\modelUser;
use Illuminate\Contracts\View\View;

class dashboardController extends Controller
{


    public function openView(Request $request){

       // print("entro a la funcion de controller depuracion: ").$request->header("Authorization");
    //    $token = $request->header("Authorization");
    //     $array = [];
    //     $replace = str_replace("Bearer ","",$token);
        $token = $request->query("token");
        $decode_token = JWTAuth::setToken($token)->authenticate();

        if($decode_token){

            $array = [
    
                "nombre" => $decode_token->nombre,
                "apellido" => $decode_token->apellido,
                "cedula" => $decode_token->apellido,
                "rol" => $decode_token->rol,
                "email" => $decode_token->email,
                "telefono" => $decode_token->telefono,
    
            ];
            return view('dashboard',["array" => $array] );
        }
    }


    public function viewRegister(){


        $labores = labores::getLabores();


        $htmlContent = view("menuDashboard.registerUser", ["labores" => $labores])->render();

        return response()->json(["status" => true, "html" => $htmlContent ]);
    }


    public function saveUser(Request $request){

        $array_request = [

            "apellido" => $request->input("apellido"),
            "cedula" => $request->input("cedula"),
            "cel_emergencia" => $request->input("cel_emergencia"),
            "celular" => $request->input("celular"),
            "contacto_emergencia" => $request->input("contacto_emergencia"),
            "direccion" => $request->input("direccion"),
            "email" => $request->input("email"),
            "labor" => $request->input("labor"),
            "nacimiento" => $request->input("nacimiento"),
            "nombre" => $request->input("nombre"),
            "password" => $request->input("password"),
            "rol" => $request->input("rol")
        ];


        $insert_data = modelUser::saveUser($array_request);


        if($insert_data) return response()->json(["status" => true]);


        return response()->json(["status" => false]);






        

    }


}