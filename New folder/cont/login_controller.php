<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Illuminate\Session\SessionManager;

class login_controller extends Controller
{

	// Inicio de la pagina
	function index()
	{
		//si el usuario ha marcado 'recordar' al loguearse
        if (Auth::viaRemember()||Auth::check()) 
        {
            return redirect('principal');
        }

        // vista inicial
    	return view('inicio/index');
	}


	//---------------------------------------------------------------
	// Validacion de usuario al loguearse
    function ingresar(Request $request, sessionManager $sessionManager)
    {
    	$this->validate($request,
    		['usuario'=>['required','min:8'],
    		'contrasenia'=>['required','min:8']]);

    	if (Auth::attempt(['name'=> $request['usuario'], 'password' => $request['contrasenia']],$request['recordar'])) 
    	{
            return redirect('principal');
        }

    	$sessionManager->flash('error', 'Usuario o contraseña incorrectos. Verifique los datos, de lo contrario su usuario puede estar deshabilitado');
    	return view('inicio/index');
	}

	// -------------------------------------------------------------------
	// cierre de sesión
	function cerrar_sesion(sessionManager $sessionManager)
	{
		// Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        $sessionManager->flash('correcto', 'Se ha cerrado la sesión exitosamente.');
        return redirect('/');
	}
}
