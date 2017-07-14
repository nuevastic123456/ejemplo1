<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Illuminate\Session\SessionManager;
use App\permiso_usuario;
use App\empresa;

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
            $user=\Auth::User();
            $permiso_usuario= permiso_usuario::where('id_tipo_usuario',$user->id_tipo_usuario)->get();
            $empresa=empresa::max('id');
            $empresa=empresa::find($empresa);

            Session()->put('empresa',$empresa);
            Session()->put('permiso_usuario',$permiso_usuario);
            Session()->put('user',$user);

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
