<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\modelAssits;
use App\Models\modelUser;

class assistController extends Controller
{

    protected $inicio_jornada = "INICIAR JORNADA LABORAL";
    protected $inicio_jornada_A = "INICIAR JORNADA ALIMENTARIA";
    protected $inicio_jornada_T = "INICIAR JORNADA LABORAL TARDE";
    protected $finalizar_jornada = "FINALIZAR JORNADA LABORAL";



    public function captureHour(Request $request){



        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ","",$token_header);

        $decode_token = JWTAuth::setToken($replace)->authenticate();
        $estado = $request->estado;
        $id_user = $decode_token["cedula"];

        $fecha = Carbon::now()->format('y-m-d');

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
            ["jornada" => $this->inicio_jornada], 
            ["jornada" => $this->inicio_jornada_A],
            ["jornada" => $this->inicio_jornada_T],
            ["jornada" => $this->finalizar_jornada],
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



    public function getShowReportAssists(){



        $get_report = modelAssits::getAssists();





        //$render = view("menuDashboard.reportAssits");



    }


    public function convertView($array){

        $data = [];

        foreach($array as $item){

            $nombre = modelUser::getUserName($item->id_user);
            $apellido = modelUser::getLastName($item->id_user);
            $inicio_jornada = modelAssits::getHour($item->id_user,$this->inicio_jornada);
            $inicio_jornada_a = modelAssits::getHour($item->id_user,$this->inicio_jornada_A);
            $inicio_jornada_t = modelAssits::getHour($item->id_user,$this->inicio_jornada_T);
            $fin = modelAssits::getHour($item->id_user,$this->finalizar_jornada);
            $fecha = modelAssits::getDate($item->id_user,$this->inicio_jornada);




            array_push($data, [

                "cedula" => $item->id_user,
                "nombre" =>  $nombre,
                "apellido" =>  $apellido,
                "Inicio_jornada" => $inicio_jornada,
                "inicio_jornada_a" => $inicio_jornada_a,
                "inicio_jornada_t" => $inicio_jornada_t,
                "finalizar_jornada" => $fin,
                "fecha" => $fecha



            ]);


        }


    }
}
