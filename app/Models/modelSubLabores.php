<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelSubLabores extends Model
{
    use HasFactory;

       protected $table = "sub_labores";
       protected $fillable = ["id_sub_labor", "id_labor", "nombre_sub_labor", "fecha_creacion", "created_at", "updated_at"];

    public static function getSubLabores(){


        return self::all();
    }


    public static function deleteSubLabors($ids){



       return  self::whereIn('id_sub_labor', $ids)->delete();

    }


    public static function addSubLabors($array){

        return self::insert($array);

    }


    public static function getSubLaborsForId($id){


        return self::where('id_labor',$id)->get();

    }
}
