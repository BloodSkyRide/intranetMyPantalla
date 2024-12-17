<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class modelPonderado extends Model
{
    use HasFactory;
    protected $table = "ponderados";
    protected $fillable = ["id_ponderado", "id_user", "nombre_user", "id_atributo", "nombre_atributo_ponderado", "fecha", "created_at", "updated_at"];



    public static function insertDataPonderado($data){

        return self::insert($data);

    }

    public static function getPonderados(){


        return self::all();
    }

    public static function verifyRegisters($id_user,$nombre_atributo_ponderado){

        return self::where("id_user", $id_user)
        ->where("nombre_atributo_ponderado",$nombre_atributo_ponderado)
        ->get();
    }

    public static function editExists($id_user, $nombre_atributo, $porcentaje){

        return self::where("id_user",$id_user)
        ->where("nombre_atributo_ponderado",$nombre_atributo)
        ->update(["ponderado" => $porcentaje]);
    }

    public static function getAllPonderados(){


        return self::all();
    }
    

    public static function truncateTable(){

        return DB::table('ponderados')->truncate();

    }

    public static function deletePonderadosForId($id_atribute){


        return self::where("id_atributo", $id_atribute)
        ->delete();

    }

    public static function getPorcentageUser($id_user){

        return self::where("id_user", $id_user)
        ->get();

    }
}
