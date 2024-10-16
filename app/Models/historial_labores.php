<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_labores extends Model
{
    use HasFactory;

    protected $table = "historial_sub_labores";

    protected $fillable = ["id_historial_sublabor","id_labor","id_user", "nombre_sub_labor","estado","fecha","hora","created_at","updated_at"];

    public static function insertHistory($data){

        return self::insert($data);

    }

    public static function getHistorySubLabors($id_labor, $id_user,$fecha){

        return self::where('id_labor', $id_labor)
        ->where("id_user", $id_user)
        ->where("fecha", $fecha)
        ->select("nombre_sub_labor")
        ->get();

    }
}
