<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoria extends Model
{
	use softDeletes;

    protected $table='categoria';
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['cat_nombre','deleted_at'];


}