<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\modelAssits;

class assistController extends Controller
{
    public function captureHour(Request $request){


        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ","",$token_header);

        $decode_token = JWTAuth::setToken($replace)->authenticate();
        $estado = $request->estado;
        $id_user = $decode_token["cedula"];

        $fecha = date("d/m/y");

        $hora = Carbon::now();

        $data = ["id_user" => $id_user, "estado" => $estado, "fecha" => $fecha, "hora" => $hora];

        $insert = modelAssits::insertHour($data);


        if($insert){

            
            $horas = modelAssits::getMyAssists($id_user,$fecha);

            $array = $horas->toArray();

            $convert_array = [];


            for($i = 0; $i < 4; $i++){

                if(isset($array[$i]['hora'])){
                    
                    $hora = $array[$i]['hora'];
                    $hora_12 = Carbon::createFromFormat('H:i:s', $hora)->format('h:i A');
                    array_push($convert_array,[

                        "horas" => $hora_12,
                        "accion" => false
                    ]);

                }else{

                    array_push($convert_array,[

                        "horas" => "N/A",
                        "accion" => true
                    ]);

                }

            }

        $eventos = [
            ["jornada" => "INICIAR JORNADA LABORAL"], 
            ["jornada" => "INICIAR JORNADA ALIMENTARIA"],
            ["jornada" => "INICIAR JORNADA LABORAL TARDE"],
            ["jornada" => "FINALIZAR JORNADA LABORAL"],
        ];
        
        
        foreach($eventos as $index => &$evento){
            
            
            if (isset($convert_array[$index])) {
                $evento = array_merge($evento, $convert_array[$index]);
            }
            
        }

            $render = view("menuDashboard.assists", ["eventos" => $eventos])->render();


            return response()->json(["status" => true, "html" => $render]);

        }

    }
}
