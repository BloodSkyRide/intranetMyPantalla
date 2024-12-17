<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class modelSaveDay extends Model
{
    use HasFactory;
    protected $table = "guardado_diario";
    protected $fillable = ["id_user", "nombre_user", "fecha", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo", "created_at", "updated_at"];


    public static function saveAtribute($id_user,$dia,$dato){

        return self::where("id_user", $id_user)
        ->update([$dia => $dato]);


    }


    public static function getAtributeForDay($id_user,$day){

        return self::where("id_user", $id_user)
        ->select($day)
        ->first();


    }

    public static function getRegister($id_user){


        return self::where("id_user", $id_user)
        ->get();


    }

    public static function insertRegister($data){

        return self::insert($data);


    }

    public static function getAtributes(){


        return self::select("lunes","martes", "miercoles","jueves", "viernes", "sabado", "domingo")->get();
    }

    public static function getAllRegister(){


        return self::all();
    }

    public static function getIdUser(){


        return self::select("id_user", "nombre_user")->get();
    }

    public static function truncateTable(){


        return DB::table('guardado_diario')->truncate();
    }


    public static function getAllUsersPorcentages(){

        return self::select("id_user", "nombre_user")->get();

    }




}
