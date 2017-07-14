<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Session\SessionManager;

class usuario_controller extends Controller
{

   // lista de usuarios con sus las respectivas opciones
   function index()
   {
   	$data['consulta_usuarios']=User::
   	join('tipo_usuario','users.id_tipo_usuario','=','tipo_usuario.id')
   	->join('municipio','users.id_municipio','=','municipio.id')
    ->join('departamento','municipio.id_departamento','=','departamento.id')
   	->join('tipo_documento','users.id_tipo_documento','=','tipo_documento.id')
    ->select('tipo_usuario.*','municipio.*','users.*','tipo_documento.*','tipo_usuario.id as id_tipo_usuario','municipio.id as id_municipio','users.id as id_usuario','tipo_documento.id as id_tipo_documento')
    ->orderBy('users.id','desc')
	  ->paginate(5);

   	return view('paginas.administrar_usuarios',$data);
   }


   // ----------------------------------------------------------
   //consultas para usar en el formulario de usuario
   function  consultas()
   {
   	  $data['tipo_documento']=DB::table('tipo_documento')->get();
   		$data['departamento']=DB::table('departamento')->get();
   		$data['tipo_usuario']=DB::table('tipo_usuario')->get();

   		return $data;
   }



   // ------------------------------------------------------
   // vista formulario de registro
   function formulario_registro()
   {
   		$data=$this->consultas();
   		return view('paginas.registrar_usuario',$data);
   }


   // -------------------------------------------------------------
   // carga select con municipios segun el departamento seleccionado. uso ajax
   function consulta_municipios($id_departamento)
   {
   		$departamento=DB::table('municipio')->where('id_departamento',$id_departamento)->get();

   		return view('paginas.vista_ajax.select_municipio')->with('departamento',$departamento);
   }




   // ----------------------------------------------------------
   // registrar usuario
   function registrar_usuario(Request $request, SessionManager $sessionManager)
   {
        // validacion del formulario
        $this->validate($request,
        ['nombre'=>['required'],
        'numero_documento'=>['required'],
        'tipo_documento'=>['required'],
        'numero_telefonico'=>['required'],
        'tipo_documento'=>['required'],
        'correo_electronico'=>['required'],
        'departamento'=>['required'],
        'municipio'=>['required'],
        'direccion'=>['required'],
        'tipo_usuario'=>['required'],
        'foto'=>[''],
        'nombre_usuario'=>['required'],
        'contrasenia'=>['required']]);

   			$usuario=new User;
   			$usuario->usu_nombre=$request->nombre;
   			$usuario->usu_numero_documento=$request->numero_documento;
   			$usuario->usu_direccion=$request->direccion;
   			$usuario->usu_numero_telefono=$request->numero_telefonico;
   			$usuario->name=$request->nombre_usuario;
   			$usuario->email=$request->correo_electronico;

        if (!empty($request->file('foto')))
        {
          $foto=$request->file('foto');
          $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
          $foto->move('public/img/usuarios/',$nombre);
          $usuario->usu_ruta_foto='public/img/usuarios/'.$nombre;
        }

        if (!empty($request->estado))
        {
          $usuario->usu_estado=$request->estado;
        }
        else
        {
          $usuario->usu_estado=0;
        }

        $usuario->password=bcrypt($request->contrasenia);
  			$usuario->id_tipo_usuario=$request->tipo_usuario;
  			$usuario->id_municipio=$request->municipio;
  			$usuario->id_tipo_documento=$request->tipo_documento;
  			$usuario->save();

  			$sessionManager->flash('correcto','Usuario registrado exitosamente.');
      		return redirect('administrar_usuarios');
   }


   // -------------------------------------------------------------------
   //vista para editar usuario
   function editar_usuario($id_usuario)
   {
   	  $data=$this->consultas();
   	  $data['consulta_usuario']=User::
   	join('tipo_usuario','users.id_tipo_usuario','=','tipo_usuario.id')
   	->join('municipio','users.id_municipio','=','municipio.id')
   	->join('tipo_documento','users.id_tipo_documento','=','tipo_documento.id')
    ->select('tipo_usuario.*','municipio.*','users.*','tipo_documento.*','tipo_usuario.id as id_tipo_usuario','municipio.id as id_municipio','users.id as id_usuario','tipo_documento.id as id_tipo_documento')
   	->where('users.id',$id_usuario)
	  ->first();

    $data['municipio']=DB::table('municipio')->where('municipio.id_departamento',$data['consulta_usuario']->id_departamento)->get();

   	  return view('paginas.editar_usuario',$data);
   }


   // ---------------------------------------------------
   // actualizar usuario
   function actualizar_usuario(Request $request, SessionManager $sessionManager, $id_usuario)
   {
        $this->validate($request,
        ['nombre'=>['required'],
        'numero_documento'=>['required'],
        'tipo_documento'=>['required'],
        'numero_telefonico'=>['required'],
        'tipo_documento'=>['required'],
        'correo_electronico'=>['required'],
        'departamento'=>['required'],
        'municipio'=>['required'],
        'direccion'=>['required'],
        'tipo_usuario'=>['required'],
        'foto'=>[''],
        'nombre_usuario'=>['required'],
        'contrasenia'=>['']]);

        $usuario=User::find($id_usuario);
        $usuario->usu_nombre=$request->nombre;
        $usuario->usu_numero_documento=$request->numero_documento;
        $usuario->usu_direccion=$request->direccion;
        $usuario->usu_numero_telefono=$request->numero_telefonico;
        $usuario->name=$request->nombre_usuario;
        $usuario->email=$request->correo_electronico;

        if (!empty($request->file('foto')))
        {
          if (!empty($usuario->usu_ruta_foto))
          {
            unlink($usuario->usu_ruta_foto);
          }

          $foto=$request->file('foto');
          $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
          $foto->move('public/img/usuarios/',$nombre);
          $usuario->usu_ruta_foto='public/img/usuarios/'.$nombre;
        }
        
        if (!empty($request->estado))
        {
          $usuario->usu_estado=$request->estado;
        }
        else
        {
          $usuario->usu_estado=0;
        }

        if (!empty($request->contrasenia)) 
        {
          $usuario->password=bcrypt($request->contrasenia);
        }

        $usuario->id_tipo_usuario=$request->tipo_usuario;
        $usuario->id_municipio=$request->municipio;
        $usuario->id_tipo_documento=$request->tipo_documento;
        $usuario->update();

        $sessionManager->flash('correcto','Los datos del usaurio se han actualizado correctamente');
        return redirect('administrar_usuarios');
   }




   // -----------------------------------------------------
   // busca usuarios por filtro
   function buscar_usuario($parametro)
   {
      $consulta_usuarios=User::
    join('tipo_usuario','users.id_tipo_usuario','=','tipo_usuario.id')
    ->join('municipio','users.id_municipio','=','municipio.id')
    ->join('departamento','municipio.id_departamento','=','departamento.id')
    ->join('tipo_documento','users.id_tipo_documento','=','tipo_documento.id')
    ->select('tipo_usuario.*','municipio.*','users.*','tipo_documento.*','tipo_usuario.id as id_tipo_usuario','municipio.id as id_municipio','users.id as id_usuario','tipo_documento.id as id_tipo_documento')
    ->where(function ($query) use ($parametro){
            $query->where('users.usu_nombre','like','%'.$parametro.'%')
        ->orWhere('users.email','like','%'.$parametro.'%')
        ->orWhere('tipo_usuario.tu_descripcion','like','%'.$parametro.'%');
    })

    ->paginate(5);

      return view('paginas.tablas.tabla_usuarios')->with('consulta_usuarios',$consulta_usuarios);
   }



   // -----------------------------------------------------
   // eliminar usurio temporalmente
   function eliminar_usuario_temporalmente($id_usuario, SessionManager $sessionManager)
   {
        $usuario=User::find($id_usuario);
        $usuario->delete();
        $sessionManager->flash('advertencia', 'El usuario ha sido eliminado temporalmente!');
        return redirect('administrar_usuarios');
   }






   function lista_usuarios_eliminados()
   {
    $consulta_usuarios=User::onlyTrashed()
    ->join('tipo_usuario','users.id_tipo_usuario','=','tipo_usuario.id')
    ->join('municipio','users.id_municipio','=','municipio.id')
    ->join('departamento','municipio.id_departamento','=','departamento.id')
    ->join('tipo_documento','users.id_tipo_documento','=','tipo_documento.id')
    ->select('tipo_usuario.*','municipio.*','users.*','tipo_documento.*','tipo_usuario.id as id_tipo_usuario','municipio.id as id_municipio','users.id as id_usuario','tipo_documento.id as id_tipo_documento')
    ->orderBy('users.id','desc')
    ->paginate(5);


    return view('paginas.tabla_eliminado.tabla_usuario')->with('consulta_usuarios',$consulta_usuarios);

   }




   function restaurar_usuario($id_usuario, SessionManager $sessionManager)
   {
    User::withTrashed()
    ->find($id_usuario)
    ->restore();
    $sessionManager->flash('correcto', 'El usuario ha sido restaurado exitosamente!');
    return redirect('registros_eliminados');
   }




   function eliminar_usuario_permanentemente($id_usuario, SessionManager $sessionManager)
   {
    User::withTrashed()
    ->find($id_usuario)
    ->forceDelete();
    $sessionManager->flash('correcto', 'El usuario ha sido eliminado exitosamente!');
    return redirect('registros_eliminados');
   }










   function reporte_usuario($fecha_inicio,$fecha_fin,$parametro)
   {

    if ($parametro==1) 
    {
    

    $consulta_usuarios=User::
    join('tipo_usuario','users.id_tipo_usuario','=','tipo_usuario.id')
    ->join('municipio','users.id_municipio','=','municipio.id')
    ->join('departamento','municipio.id_departamento','=','departamento.id')
    ->join('tipo_documento','users.id_tipo_documento','=','tipo_documento.id')
    ->select('tipo_usuario.*','municipio.*','users.*','tipo_documento.*','tipo_usuario.id as id_tipo_usuario','municipio.id as id_municipio','users.id as id_usuario','tipo_documento.id as id_tipo_documento')
    ->where(function ($query) use ($parametro,$fecha_inicio,$fecha_fin){
            $query->whereBetween('users.created_at', [$fecha_inicio, $fecha_fin]);

    })
    ->get();

    return view('paginas.tablas.tabla_usuarios')->with('consulta_usuarios',$consulta_usuarios);

   }

 }


}
