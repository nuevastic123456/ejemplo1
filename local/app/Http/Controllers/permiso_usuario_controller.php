<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\permiso;
use App\tipo_usuario;
use App\permiso_usuario;

class permiso_usuario_controller extends Controller
{
	// vista de tipos de usuario y permisos
    function index()
    {
    	$data['permisos_usuario']=permiso_usuario::get();
    	$data['permisos']=permiso::get();
    	$data['tipo_usuario']=tipo_usuario::paginate(5);
    	return view('paginas.permisos_usuario',$data);
    }


    // dar permiso al tipo de usuario
    function dar_permiso_usuario($id_permiso, $id_tipo_usuario)
    {
    	$permisos_usuario= new permiso_usuario;
    	$permisos_usuario->id_permiso=$id_permiso;
    	$permisos_usuario->id_tipo_usuario=$id_tipo_usuario;
    	$permisos_usuario->save();

        return 'se ha establecido el permiso correctamente !';
    }

     // cancelar permiso al tipo de usuario
    function cancelar_permiso_usuario($id_permiso, $id_tipo_usuario)
    {
    	$permisos_usuario=permiso_usuario::where('id_permiso',$id_permiso)
    	->where('id_tipo_usuario',$id_tipo_usuario)->delete();
    	return 'se ha cancelado el permiso';

    }
}
