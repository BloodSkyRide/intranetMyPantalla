<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelAssits extends Model
{
    use HasFactory;
    protected $table = "historial_asistencia";
    protected $fillable = ["id_historial_asistencia","id_user","estado", "fecha", "hora", "created_at", "updated_at"];



    public static function insertHour($data){


        return self::insert($data);


    }


    public static function getMyAssists($id,$fecha){


        return self::where('id_user',$id)
        ->where("fecha",$fecha)
        ->get();

    }


    public static function getAssists(){


        return self::orderBy("id_historial_asistencia", "desc")->limit(20)->get();

    }


    public static function getHour($id_user,$action){


        return self::where("id_user",$id_user)
        ->where("estado", $action)
        ->select("hora")
        ->get();
    }


    public static function getDate($id_user,$action){


        return self::where("id_user",$id_user)
        ->where("estado", $action)
        ->select("fecha")
        ->get();
    }
}
