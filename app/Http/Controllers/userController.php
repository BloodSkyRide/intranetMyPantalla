<?php

namespace App\Http\Controllers;
use App\Models\modelUser;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function getUserForId(Request $request){

        $cedula = $request->cedula;

        $register = modelUser::getUserForId($cedula);

        return response()->json(["status" => true,"datos" => $register]);

    }
}
