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
    //


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
        $estado = $request->estado;
        $id_user = $decode_token["cedula"];

        $fecha = date("d/m/y");



    }
}
