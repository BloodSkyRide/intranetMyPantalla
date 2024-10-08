<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class labores extends Model
{
    use HasFactory;



    public static  function getLabores(){


        return labores::all();

    }
}
