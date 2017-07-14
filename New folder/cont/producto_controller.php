<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\producto;
use App\categoria;
use App\unidad;
use Illuminate\Session\SessionManager;

class producto_controller extends Controller
{
    
   // lista de usuarios con sus las respectivas opciones
   function index()
   {
   	$data['consulta_productos']=producto::
   	join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')
	->paginate(5);

   	return view('paginas.administrar_productos',$data);
   }


   // ----------------------------------------------------------
   //consultas para usar en el formulario de producto
   function  cunsultas()
   {
   	  $data['categoria']=categoria::get();
   		$data['unidad']=unidad::get();

   		return $data;
   }


    // ------------------------------------------------------
   // vista formulario de registro
   function formulario_registro()
   {
   		$data=$this->cunsultas();
   		return view('paginas.registrar_producto',$data);
   }



   // ----------------------------------------------------------
   // registrar producto
   function registrar_producto(Request $request, SessionManager $sessionManager)
   {
        $this->validate($request,
        ['nombre'=>['required'],
        'codigo'=>['required'],
        'categoria'=>['required'],
        'stock_minimo'=>['required'],
        'stock_maximo'=>['required'],
        'unidad'=>['required'],
        'foto'=>['']]);

   			$producto=new producto;
   			$producto->pro_nombre=$request->nombre;
   			$producto->pro_codigo=$request->codigo;
   			$producto->id_categoria=$request->categoria;
   			$producto->id_unidad=$request->unidad;
   			$producto->pro_stock_minimo=$request->stock_minimo;
   			$producto->pro_stock_maximo=$request->stock_maximo;
   			
        if (!empty($request->bloqueado))
        {
            $usuario->usu_estado=$request->bloqueado;
        }
        else
        {
          $usuario->usu_estado=0;
        }

	      if (!empty($request->file('foto')))
	      {
	         $foto=$request->file('foto');
	         $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
	         $foto->move('public/img/productos/',$nombre);
	         $producto->pro_ruta_foto='public/img/productos/'.$nombre;
	      }

  			$producto->save();

  			$sessionManager->flash('correcto','Producto registrado exitosamente.');
      		return redirect('administrar_productos');
   }




   // -------------------------------------------------------------------
   //vista para editar uel producto
   function editar_producto($id_producto)
   {
   	  $data=$this->cunsultas();
   	  $data['consulta_producto']=producto::
   	join('categoria','producto.id_categoria','=','categoria.id')
   	->join('unidad','producto.id_unidad','=','unidad.id')
   	->where('producto.id',$id_producto)
	->first();
   	  return view('paginas.editar_producto',$data);
   }



   // -----------------------------------------------------
   // busca productos por filtro
   function buscar_producto($parametro)
   {
      $consulta_productos=producto::
    join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')

    ->where(function ($query) use ($parametro){
            $query->where('producto.pro_nombre','like','%'.$parametro.'%')
        ->orWhere('producto.pro_codigo','like','%'.$parametro.'%')
        ->orWhere('categoria.cat_descripcion','like','%'.$parametro.'%');
    })

    ->paginate(5);

      return view('paginas.tablas.tabla_productos')->with('consulta_productos',$consulta_productos);
   }



   // -----------------------------------------------------
   // eliminar producto temporalmente
   function eliminar_producto_temporalmente($id_producto, SessionManager $sessionManager)
   {
        $producto=producto::find($id_producto);
        $producto->delete();
        $sessionManager->flash('advertencia', 'El producto ha sido eliminado temporalmente!');
        return redirect('administrar_productos');
   }


}
