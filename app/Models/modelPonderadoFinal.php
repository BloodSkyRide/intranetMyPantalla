<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelPonderadoFinal extends Model
{
    use HasFactory;
    protected $table = "ponderado_final";
    protected $fillable = ["id_final", "id_user", "nombre_user", "apellido_user", "ponderado_final", "fecha", "created_at", "updated_at"];


    public static function insertDataEnd($data){

        return self::insert($data);

    }

    public static function getAllData(){


        return self::all();
    }

    public static function getAllDataForDate($fecha){


        return self::where("fecha", ">=", $fecha)->get();
    }
}
