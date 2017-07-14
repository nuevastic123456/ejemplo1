<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class producto extends Model
{
	use softDeletes;

    protected $table='producto';
    
    protected $dates = ['deleted_at'];
   
    protected $fillable = ['pro_nombre','deleted_at'];
    
}
