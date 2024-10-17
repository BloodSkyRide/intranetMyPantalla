<?php

namespace App\Http\Controllers;

use App\Models\historial_labores;
use App\Models\modelUser;
use Carbon\Carbon;

use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;

class historySubLaborsController extends Controller
{


    public function searchText(Request $request){

        $range = $request->range;
        $text = $request->text;

        
        $range_array = explode(" - ",$range);

        $range_min = Carbon::parse($range_array[0])->format('Y-m-d');

        $range_max = Carbon::parse($range_array[1])->format('Y-m-d');

        $serach = historial_labores::searcherForText($range_min,$range_max,$text);
        
        if ($serach) {

            $data =  self::transformHistory($serach);

            $render = view("menuDashboard.historySubLabors", ["historial" => $data])->render();

            return response()->json(["status" => true, "html" => $render]);
        }


    }



    public function searchForRange(Request $request){


        $range = $request->range;

        $range_array = explode(" - ",$range);

        $range_min = Carbon::parse($range_array[0])->format('Y-m-d');

        $range_max = Carbon::parse($range_array[1])->format('Y-m-d');

        $searcherForDate = historial_labores::searchforDate($range_min,$range_max);


        if ($searcherForDate) {

            $data =  self::transformHistory($searcherForDate);

            $render = view("menuDashboard.historySubLabors", ["historial" => $data])->render();

            return response()->json(["status" => true, "html" => $render]);
        }


    }


    public function getShowHistorySubLabors(Request $request)
    {


        $token = $request->header("Authorization");
        $replace = str_replace("Bearer ", "", $token);


        $decode_token = JWTAuth::setToken($replace)->authenticate();


        $get_history = historial_labores::showHistory();

        if ($get_history) {

            $data =  self::transformHistory($get_history);

            $render = view("menuDashboard.historySubLabors", ["historial" => $data])->render();

            return response()->json(["status" => true, "html" => $render]);
        }
    }



    public function transformHistory($history)
    {

        $array_transform = [];

        foreach ($history as $item) {

            $nombre_user = modelUser::getUserName($item->id_user);
            $last_name = modelUser::getLastName($item->id_user);

            array_push($array_transform,[

                "nombre_user" => $nombre_user->nombre,
                "apellido" =>$last_name->apellido,
                "sub_labor" => $item->nombre_sub_labor,
                "hora" => $item->hora,
                "fecha" => Carbon::parse($item->fecha)->format('d/m/Y'),
                "estado" =>$item->estado

            ]);

        }


        return $array_transform;
    }
}
