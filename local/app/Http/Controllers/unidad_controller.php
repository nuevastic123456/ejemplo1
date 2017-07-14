<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unidad;
use Illuminate\Session\SessionManager;

class unidad_controller extends Controller
{


    // vista unidaes de medida registradas
    function index()
    {
        $unidades=unidad::orderBy('id','desc')
        ->paginate(5);
        return view('paginas.administrar_unidades_de_medida')->with('unidades',$unidades);
    }


    function formulario_registro()
    {
        return view('paginas.registrar_unidad_medida');
    }


    // la uso para no repetir el procedimiento de registro
    function registro_general($request)
    {
        $unidad=new unidad;
        $unidad->uni_nombre=$request->nombre;
        $unidad->uni_descripcion=$request->descripcion;
        if (!empty($request->estado))
        {
            $unidad->uni_estado=$request->estado;
        }
        else
        {
            $unidad->uni_estado=0;
        }
        $unidad->save();

    }



    //formulario para registrar categoria
    function registrar_unidad_ajax(Request $request)
    {
        $this->registro_general($request);
        $unidad=unidad::get();
        return view('paginas.vista_ajax.select_unidad')->with('unidad',$unidad);

    }





    //formulario para registrar categoria
    function registrar_unidad_medida(Request $request,SessionManager $sessionManager)
    {
        $this->validate($request,
        ['nombre'=>['required'],
        'descripcion'=>['required']]);

        $this->registro_general($request);
        $sessionManager->flash('correcto','Unidad de medida registrada exitosamente.');
        return redirect('administrar_unidades');
    }






   // -------------------------------------------------------------------
   //vista para editar uel producto
   function editar_unidad_medida($id_unidad)
   {
        $data['consulta_unidad']=unidad::
        find($id_unidad);
        return view('paginas.editar_unidad_medida',$data);
   }



   function actualizar_unidad_medida(Request $request, SessionManager $sessionManager, $id_unidad)
   {
        $this->validate($request,
        ['nombre'=>['required'],
        'descripcion'=>['required']]);

        $unidad=unidad::find($id_unidad);
        $unidad->uni_nombre=$request->nombre;
        $unidad->uni_descripcion=$request->descripcion;
        if (!empty($request->estado))
        {
            $unidad->uni_estado=$request->estado;
        }
        else
        {
            $unidad->uni_estado=0;
        }

        $unidad->update();
        $sessionManager->flash('correcto','Unidad de medida actualizada exitosamente.');
        return redirect('administrar_unidades');
   }



   // -----------------------------------------------------
   // busca usuarios por filtro
   function buscar_unidad_medida($parametro)
   {
      $consulta_unidad=unidad::where(function ($query) use ($parametro){
            $query->where('uni_nombre','like','%'.$parametro.'%')
        ->orWhere('uni_descripcion','like','%'.$parametro.'%');
    })
    ->paginate(5);

      return view('paginas.tablas.tabla_unidades')->with('unidaes',$consulta_unidad);
   }




   // -----------------------------------------------------
   // eliminar categoria temporalmente
   function eliminar_unidad_temporalmente($id_unidad, SessionManager $sessionManager)
   {
        $unidad=unidad::find($id_unidad);
        $unidad->delete();
        $sessionManager->flash('advertencia', 'La unidad ha sido eliminada temporalmente!');
        return redirect('administrar_unidades');
   }




   function lista_unidades_eliminadas()
   {
    $consulta_unidades=unidad::onlyTrashed()
    ->get();

    return view('paginas.tabla_eliminado.tabla_unidad')->with('unidades',$consulta_unidades);

   }




   function restaurar_categoria($id_unidad, SessionManager $sessionManager)
   {
    unidad::withTrashed()
    ->find($id_unidad)
    ->restore();
    $sessionManager->flash('correcto', 'La unidad ha sido restaurada exitosamente!');
    return redirect('registros_eliminados');
   }




   function eliminar_unidad_permanentemente($id_unidad, SessionManager $sessionManager)
   {
    unidad::withTrashed()
    ->find($id_unidad)
    ->forceDelete();
    $sessionManager->flash('correcto', 'La unidad ha sido eliminada exitosamente!');
    return redirect('registros_eliminados');
   }

}
