<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelAtributes extends Model
{
    use HasFactory;
    protected $table = "atributos";
    protected $fillable = ["id_atributo", "nombre", "%_efectividad", "fecha"];

    public static function insertAtribute($data){


        return self::insert($data);


    }


    public static function getColumnsAtributes(){


        return self::all();


    }

    public static function getPorcentual($name_atribute){


       return self::where("nombre_atributo", $name_atribute)
        ->select("porcentaje_efectividad")
        ->first();
    }

    public static function getIdForName($name_atribute){


        return self::where("nombre_atributo", $name_atribute)
        ->select("id_atributo")
        ->first();
    }
}
