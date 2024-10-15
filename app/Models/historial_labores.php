<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_labores extends Model
{
    use HasFactory;

    protected $table = "historial_labores";

    protected $fillable = ["id_historial","id_sub_labor","id_user", "fecha","estado","created_at","updated_at"];


    public static function insertHistory($data){





    }
}
