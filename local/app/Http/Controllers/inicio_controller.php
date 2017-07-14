<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inicio_controller extends Controller
{

	// pagina principal al iniciar sesion
    function principal()
    {
    	return view('paginas.inicio');
    }
}
