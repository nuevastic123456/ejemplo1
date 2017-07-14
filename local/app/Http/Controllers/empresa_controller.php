<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\empresa;
use Illuminate\Session\SessionManager;


class empresa_controller extends Controller
{
   function index()
   {
   	 $consulta_empresa=empresa::max('id');
   	 $consulta_empresa=empresa::find($consulta_empresa);
     Session()->put('empresa',$consulta_empresa);
   	 return view('paginas.informacion_empresa')->with('empresa',$consulta_empresa);
   }

   function guardar_datos(Request $request, SessionManager $sessionManager)
   {
   	$empresa=empresa::max('id');
   	$empresa=empresa::find($empresa);
   	if (count($empresa)>0) 
   	{

		   	$empresa->emp_nombre=$request->nombre;
			$empresa->emp_nit=$request->nit;
			$empresa->emp_email=$request->email;
			$empresa->emp_telefono=$request->telefono;
			$empresa->emp_nombre_propietario=$request->propietario;

			if (!empty($request->file('logo')))
			{
				if(!empty($empresa->emp_ruta_logo))
				{
					unlink($empresa->emp_ruta_logo);
				}
			         $foto=$request->file('logo');
			         $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
			         $foto->move('public/img/empresa/',$nombre);
			         $empresa->emp_ruta_logo='public/img/empresa/'.$nombre;
			}

			$empresa->update();

	}
	else
	{
			$empresa=new empresa;
		   	$empresa->emp_nombre=$request->nombre;
			$empresa->emp_nit=$request->nit;
			$empresa->emp_email=$request->email;
			$empresa->emp_telefono=$request->telefono;
			$empresa->emp_nombre_propietario=$request->propietario;

			if (!empty($request->file('logo')))
			{
				if(!empty($empresa->emp_ruta_logo))
				{
					unlink($empresa->emp_ruta_logo);
				}
			         $foto=$request->file('logo');
			         $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
			         $foto->move('public/img/empresa/',$nombre);
			         $empresa->emp_ruta_logo='public/img/empresa/'.$nombre;
			}

			$empresa->save();
	}

    $sessionManager->flash('correcto','Los datos de la empresa se han guardado exitosamente.');
    return redirect('empresa');
   }
}
