<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class modelUser extends Authenticatable implements JWTSubject
{
    use HasFactory;

    // Indica la tabla de la base de datos que se utilizará
    protected $table = 'users';

    // Este método obtiene un usuario basado en la cédula
    public static function getuserAndPassword($cedula)
    {
        return self::where('cedula', $cedula)->first();
    }

    // Método requerido por JWT
    public function getJWTIdentifier()
    {
        return $this->getKey(); // devuelve el ID del usuario
    }

    // Método requerido por JWT
    public function getJWTCustomClaims()
    {
        return []; // puedes agregar datos personalizados al token si es necesario
    }

    public static function saveUser($data){


        return modelUser::create($data);
    }



}
