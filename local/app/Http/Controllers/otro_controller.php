<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class otro_controller extends Controller
{
    function index()
    {
    	return view('paginas.eliminado');
    }



    function vista_reportes()
    {
    	return  view('paginas.reportes');
    }

}
