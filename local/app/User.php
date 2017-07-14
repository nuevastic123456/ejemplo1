<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable,softDeletes;

    protected $table='users';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'usu_nombre', 'usu_numero_documento', 'usu_direccion','usu_numero_telefono','name','email','usu_ruta_foto','password','usu_estado','usu_administrador','id_tipo_usuario','id_municipio','id_tipo_documento','usu_fecha_ingreso'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
