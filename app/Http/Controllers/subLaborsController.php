<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\modelSubLabores;
use App\Models\labores;
use App\Models\historial_labores;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class subLaborsController extends Controller
{

    public function deleteSubLabors(Request $request){

        $array = $request->ids_deletes;

        $asocciate = [];

        foreach($array as $item){

            array_push($asocciate,[

                "id_sub_labor" => $item

            ]);

        }

        
        
        $deleted = modelSubLabores::deleteSubLabors($asocciate);
        
       

        if($deleted){

            $labores = labores::getLabores();
        
            $getSubLabores = modelSubLabores::getSubLabores();
    
            $htmlContent = view("menuDashboard.manejoLabores", ["labores" => $labores, "sublabores" => $getSubLabores])->render();
    
            return response()->json(["status" => true, "html" => $htmlContent]);

        }


    }


    public function insertSubLabor(Request $request){


        $array_subLabors = $request->texts;

        $labor_principal = $request->id_labor_principal;

        $array = [];
        foreach($array_subLabors as $sublabors){

            array_push($array,[

                "nombre_sub_labor" => $sublabors,
                "id_labor" => $labor_principal,
                "estado" => "PENDIENTE",
                "fecha_creacion" => Carbon::now()
            ]);

        }

        $insert = modelSubLabores::addSubLabors($array);


        if($insert){

        
            $labores = labores::getLabores();
        

            $getSubLabores = modelSubLabores::getSubLabores();
    
            
            $htmlContent = view("menuDashboard.manejoLabores", ["labores" => $labores, "sublabores" => $getSubLabores])->render();
    
    
    
            return response()->json(["status" => true, "html" => $htmlContent]);

        }
        

    }




    public function historySubLabor(Request $request){


        $checked = $request->checked;

        
        $token_header = $request->header("Authorization");

        $replace = str_replace("Bearer ","",$token_header);

        $decode_token = JWTAuth::setToken($replace)->authenticate();

        $id_user = $decode_token["cedula"];
        $id_labor = $decode_token["id_labor"];

        $fecha = Carbon::now()->format('y-m-d');
        
        $hora = Carbon::now();


        $inserts = count($checked);
        $confirm = 0;

        
        foreach($checked as $nombre){
            
            $data = ["id_user" => $id_user, "id_labor" => $id_labor, "nombre_sub_labor"=> $nombre, "estado" => "REALIZADO", "fecha" => $fecha, "hora" => $hora];
            $insert = historial_labores::insertHistory($data);

            if($insert){

                $state = "REALIZADO";
                $change_state = modelSubLabores::changeStateSubLabor($id_labor,$nombre,$state);
                $confirm++;
            }

        }

        if($inserts === $confirm){

            $state_pending = "PENDIENTE";

            $getGroupLabors = modelSubLabores::getSubLaborsForId($id_labor,$state_pending);

            if ($getGroupLabors) {
    
    
                $render = view("menuDashboard.myLabors", ["sublabors" => $getGroupLabors])->render();
    
                return response()->json(["status" => true, "html" => $render]);
            }

        }


        return response()->json(["status" => false, "messagge" => "No se pudó acceder a la base de datos para las sub labores!"]);

        
    }



    public function rechargeSubLabors(Request $request){

        $checked = $request->checked;

        $state_pending = "PENDIENTE";

        $asocciate = [];

        foreach($checked as $item){

            array_push($asocciate,[

                "id_sub_labor" => $item

            ]);

        }

        $recharge_states = modelSubLabores::rechargeSubLabors($asocciate,$state_pending);

        if($recharge_states){


            return response()->json(["status" => true]);
        }


        return response()->json(["status" => false]);

    }
}
