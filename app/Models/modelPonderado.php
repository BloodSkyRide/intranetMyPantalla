<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public static function verifyRegisters($id_user){

        return self::where("id_user", $id_user)
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
}
