<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminLaborsController extends Controller
{
    public function insertSubLabor(Request $request){


        $array_subLabors = $request->array_labors;

        $labor_principal = $request->id_labor_principal;


        

    }
}
