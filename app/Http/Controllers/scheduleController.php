<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\modelUser;

class scheduleController extends Controller
{


    public function getShowSchedule(Request $request){

        $users = modelUser::getAllUsers();
        
        $render = view("menuDashboard.schedules", ["users" => $users])->render();

        return response()->json(["status" => true, "html" => $render]);

    }
    
}
