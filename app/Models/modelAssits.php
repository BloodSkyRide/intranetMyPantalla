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
}
