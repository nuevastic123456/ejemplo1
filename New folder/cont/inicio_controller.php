<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicio_controller extends Controller
{
    function principal()
    {
    	return view('paginas.inicio');
    }
}
