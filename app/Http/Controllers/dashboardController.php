<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\labores;
use App\Models\modelUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use Carbon\Carbon;

class dashboardController extends Controller
{


    public function openView(Request $request)
    {

        // print("entro a la funcion de controller depuracion: ").$request->header("Authorization");
        //    $token = $request->header("Authorization");
        //     $array = [];
        //     $replace = str_replace("Bearer ","",$token);
        $token = $request->query("token");
        $decode_token = JWTAuth::setToken($token)->authenticate();

        if ($decode_token) {

            $array = [

                "nombre" => $decode_token->nombre,
                "apellido" => $decode_token->apellido,
                "cedula" => $decode_token->apellido,
                "rol" => $decode_token->rol,
                "email" => $decode_token->email,
                "telefono" => $decode_token->telefono,

            ];
            return view('dashboard', ["array" => $array]);
        }
    }


    public function viewRegister()
    {


        $labores = labores::getLabores();


        $htmlContent = view("menuDashboard.registerUser", ["labores" => $labores])->render();

        return response()->json(["status" => true, "html" => $htmlContent]);
    }


    public function saveUser(Request $request)
    {
        
        try {
            
            $validate = $request->validate([
                
                "apellido" => "required|string|max:255",
                "cedula" => "required|string|unique:users,cedula",
                "contacto_emergencia" => "required|string",
                "celular" => "required|string|max:255|unique:users,telefono",
                "nombre_contacto" => "required|string|max:255",
                "direccion" => "required|string|max:255",
                "email" => "required|email|unique:users,email",
                "labor" => "required|string",
                "nacimiento" => "required|date|before:".Carbon::now()->subYears(18)->toDateString(),
                "nombre" => "required|string|max:255",
                "password" => "required|string",
                "rol" => "required|string|max:255"
                
            ]);
            
            $validate["password"] = Hash::make($validate["password"]);

                    $array_request = [
            
            "apellido" => $validate["apellido"],
            "cedula" => $validate["cedula"],
            "contacto_emergencia" => $validate["contacto_emergencia"],
            "telefono" => $validate["celular"],
            "nombre_contacto" => $validate["nombre_contacto"],
            "direccion" => $validate["direccion"],
            "email" => $validate["email"],
            "id_labor" => $validate["labor"],
            "nacimiento" => $validate["nacimiento"],
            "nombre" => $validate["nombre"],
            "password" => $validate["password"],
            "rol" => $validate["rol"],
            "fecha_registro" => Carbon::now()
        ];



            $insert_data = modelUser::saveUser($array_request);

            
            if ($insert_data) return response()->json(["status" => true]);

        } catch (\Throwable $th) {


            return response()->json(["status" => false, "error" => $th]);

        }




    }
}
