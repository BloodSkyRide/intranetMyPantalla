<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelOverTime extends Model
{
    use HasFactory;

    protected $fillable = ["id_notificacion", "id_user", "nombre", "apellido", "fecha_solicitud", "hora_solicitud", "hora_inicio", "hora_final", "fecha_notificacion", "motivo", "estado", "crteated_at", "updated_at"];
    protected $table = "historial_notificaciones";


    public static function insertNotification($data){


        return self::insert($data);

    }


    public static function getAllNotifications(){

        return  self::orderBy("fecha_solicitud", "asc")->get();

    }

    public static function changeState($state,$id_user){


        return self::where("id_user", $id_user)
        ->update(["estado" => $state]);

    }


}
