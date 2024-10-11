<?php

namespace App\Http\Controllers;
use App\Models\labores;
use Illuminate\Http\Request;
use App\Models\modelSubLabores;

class laborController extends Controller
{
    public function insertLabor(Request $request){


        $name = $request->name_labor;

        $insert = labores::insertLabor($name);


        if($insert){



            $labores = labores::getLabores();
        

            $getSubLabores = modelSubLabores::getSubLabores();
    
            
            $htmlContent = view("menuDashboard.manejoLabores", ["labores" => $labores, "sublabores" => $getSubLabores])->render();
    
    
    
            return response()->json(["status" => true, "html" => $htmlContent]);
        }


    }
}
