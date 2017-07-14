<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categoria;
use Illuminate\Session\SessionManager;

class categoria_controller extends Controller
{

    // vista de categorias registradas
    function index()
    {
        $categorias=categoria::orderBy('id','desc')
        ->paginate(5);

        return view('paginas.administrar_categorias')->with('categorias',$categorias);
    }



    function registro_general($request)
    {
        $categoria=new categoria;
        $categoria->cat_nombre=$request->nombre;
        $categoria->cat_descripcion=$request->descripcion;
        if (!empty($request->estado))
        {
            $categoria->cat_estado=$request->estado;
        }
        else
        {
            $categoria->cat_estado=0;
        }

        $categoria->save();
    }




    //formulario para registrar categoria
    function registrar_categoria_ajax(Request $request)
    {
        $this->registro_general($request);
        $categoria=categoria::get();
        return view('paginas.vista_ajax.select_categoria')->with('categoria',$categoria);
    }



    // ------------------------------------------------------
   // vista formulario de registro
   function formulario_registro()
   {
        return view('paginas.registrar_categoria');
   }



    // ------------------------------------------------------
    //formulario para registrar categoria
    function registrar_categoria(Request $request, SessionManager $sessionManager)
    {
        $this->validate($request,
        ['nombre'=>'required',
        'descripcion'=>'required']);

        $this->registro_general($request);
        $sessionManager->flash('correcto','categoria registrada exitosamente.');
        return redirect('administrar_categorias');
    }



   // -------------------------------------------------------------------
   //vista para editar uel producto
   function editar_categoria($id_categoria)
   {
        $data['consulta_categoria']=categoria::
        find($id_categoria);
        return view('paginas.editar_categoria',$data);
   }



   function actualizar_categoria(Request $request, SessionManager $sessionManager, $id_categoria)
   {
        $this->validate($request,
        ['nombre'=>['required'],
        'descripcion'=>['required']]);

        $categoria=categoria::find($id_categoria);
        $categoria->cat_nombre=$request->nombre;
        $categoria->cat_descripcion=$request->descripcion;
        if (!empty($request->estado))
        {
            $categoria->cat_estado=$request->estado;
        }
        else
        {
            $categoria->cat_estado=0;
        }

        $categoria->update();
        $sessionManager->flash('correcto','categoría actualizada exitosamente.');
        return redirect('administrar_categorias');
   }



   // -----------------------------------------------------
   // busca usuarios por filtro
   function buscar_categoria($parametro)
   {
      $consulta_categoria=categoria::where(function ($query) use ($parametro){
            $query->where('cat_nombre','like','%'.$parametro.'%')
        ->orWhere('cat_descripcion','like','%'.$parametro.'%');
    })
    ->paginate(5);

      return view('paginas.tablas.tabla_categorias')->with('categorias',$consulta_categoria);
   }




   // -----------------------------------------------------
   // eliminar categoria temporalmente
   function eliminar_categoria_temporalmente($id_categoria, SessionManager $sessionManager)
   {
        $categoria=categoria::find($id_categoria);
        $categoria->delete();
        $sessionManager->flash('advertencia', 'La categoria ha sido eliminada temporalmente!');
        return redirect('administrar_categorias');
   }



   function lista_categorias_eliminadas()
   {
    $consulta_categorias=categoria::onlyTrashed()
    ->get();

    return view('paginas.tabla_eliminado.tabla_categoria')->with('categorias',$consulta_categorias);

   }




   function restaurar_categoria($id_categoria, SessionManager $sessionManager)
   {
    categoria::withTrashed()
    ->find($id_categoria)
    ->restore();
    $sessionManager->flash('correcto', 'La categoria ha sido restaurada exitosamente!');
    return redirect('registros_eliminados');
   }




   function eliminar_categoria_permanentemente($id_categoria, SessionManager $sessionManager)
   {
    categoria::withTrashed()
    ->find($id_categoria)
    ->forceDelete();
    $sessionManager->flash('correcto', 'La categoria ha sido eliminada exitosamente!');
    return redirect('registros_eliminados');
   }

}

