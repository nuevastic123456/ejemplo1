<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class unidad extends Model
{
	use softDeletes;
    protected $table='unidad';
    protected $dates = ['deleted_at'];

}
