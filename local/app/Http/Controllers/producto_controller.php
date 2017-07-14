<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\producto;
use App\categoria;
use App\unidad;
use App\precio;
use App\producto_precio;

use Illuminate\Session\SessionManager;

class producto_controller extends Controller
{
    
   // lista de usuarios con sus las respectivas opciones
   function index()
   {
   	$data['consulta_productos']=producto::
   	join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')
    ->select('producto.*','categoria.*','unidad.*','producto.id as id_producto','categoria.id as id_categoria','unidad.id as id_unidad')
    ->orderBy('producto.id','desc')
	  ->paginate(5);

   	return view('paginas.administrar_productos',$data);
   }


   // ----------------------------------------------------------
   //consultas para usar en el formulario de producto
   function  consultas()
   {
   	  $data['categoria']=categoria::get();
   		$data['unidad']=unidad::get();

   		return $data;
   }


    // ------------------------------------------------------
   // vista formulario de registro
   function formulario_registro()
   {
   		$data=$this->consultas();
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
        'input_precio'=>['required'],
        'foto'=>['']]);


   			$producto=new producto;
   			$producto->pro_nombre=$request->nombre;
   			$producto->pro_codigo=$request->codigo;
   			$producto->id_categoria=$request->categoria;
   			$producto->id_unidad=$request->unidad;
   			$producto->pro_stock_minimo=$request->stock_minimo;
   			$producto->pro_stock_maximo=$request->stock_maximo;
   			
        if (!empty($request->estado))
        {
            $producto->pro_estado=$request->estado;
        }
        else
        {
            $producto->pro_estado=0;
        }

	      if (!empty($request->file('foto')))
	      {
	         $foto=$request->file('foto');
	         $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
	         $foto->move('public/img/productos/',$nombre);
	         $producto->pro_ruta_foto='public/img/productos/'.$nombre;
	      }

  			$producto->save();

        foreach (json_decode($request->input_precio) as $row) {
            $precio=new precio;
            $precio->pre_precio_venta=$row->precio;
            $precio->pre_descripcion=$row->descripcion_precio;
            $precio->pre_estado=1;
            $precio->save();

            $producto_precio=new producto_precio;
            $producto_precio->id_producto=$producto->id;
            $producto_precio->id_precio=$precio->id;
            $producto_precio->save();
        }

  			$sessionManager->flash('correcto','Producto registrado exitosamente.');
      	return redirect('administrar_productos');
   }




   // -------------------------------------------------------------------
   //vista para editar uel producto
   function editar_producto($id_producto)
   {
   	  $data=$this->consultas();
   	  $data['consulta_producto']=producto::
   	join('categoria','producto.id_categoria','=','categoria.id')
   	->join('unidad','producto.id_unidad','=','unidad.id')
    ->select('producto.*','categoria.*','unidad.*','producto.id as id_producto','categoria.id as id_categoria','unidad.id as id_unidad')
   	->where('producto.id',$id_producto)
	  ->first();
   	  return view('paginas.editar_producto',$data);
   }



   // ---------------------------------------------------
   // actualizar usuario
   function actualizar_producto(Request $request, SessionManager $sessionManager, $id_producto)
   {

        $this->validate($request,
        ['nombre'=>['required'],
        'codigo'=>['required'],
        'categoria'=>['required'],
        'stock_minimo'=>['required'],
        'stock_maximo'=>['required'],
        'unidad'=>['required'],
        'foto'=>['']]);

        $producto=producto::find($id_producto);
        $producto->pro_nombre=$request->nombre;
        $producto->pro_codigo=$request->codigo;
        $producto->id_categoria=$request->categoria;
        $producto->id_unidad=$request->unidad;
        $producto->pro_stock_minimo=$request->stock_minimo;
        $producto->pro_stock_maximo=$request->stock_maximo;
        
        if (!empty($request->estado))
        {
            $producto->pro_estado=$request->estado;
        }
        else
        {
            $producto->pro_estado=0;
        }

        if (!empty($request->file('foto')))
        {
          if (!empty($producto->pro_ruta_foto))
          {
            unlink($producto->pro_ruta_foto);
          }

           $foto=$request->file('foto');
           $nombre='('.rand(1,1000).')'.$foto->getClientOriginalName();
           $foto->move('public/img/productos/',$nombre);
           $producto->pro_ruta_foto='public/img/productos/'.$nombre;
        }

        $producto->update();

        $sessionManager->flash('correcto','Los datos del producto se han actualizado exitosamente.');
          return redirect('administrar_productos');

   }


   // -----------------------------------------------------
   // busca productos por filtro
   function buscar_producto($parametro)
   {
      $consulta_productos=producto::
    join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')
    ->select('producto.*','categoria.*','unidad.*','producto.id as id_producto','categoria.id as id_categoria','unidad.id as id_unidad')
    ->where(function ($query) use ($parametro){
            $query->where('producto.pro_nombre','like','%'.$parametro.'%')
        ->orWhere('producto.pro_codigo','like','%'.$parametro.'%')
        ->orWhere('categoria.cat_nombre','like','%'.$parametro.'%');
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



   function lista_productos_eliminados()
   {
    $consulta_productos=producto::onlyTrashed()
    ->join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')
    ->select('producto.*','categoria.*','unidad.*','producto.id as id_producto','categoria.id as id_categoria','unidad.id as id_unidad')
    ->orderBy('producto.id','desc')
    ->get();


    return view('paginas.tabla_eliminado.tabla_producto')->with('consulta_productos',$consulta_productos);

   }




   function restaurar_producto($id_producto, SessionManager $sessionManager)
   {
    producto::withTrashed()
    ->find($id_producto)
    ->restore();
    $sessionManager->flash('correcto', 'El producto ha sido restaurado exitosamente!');
    return redirect('registros_eliminados');
   }




   function eliminar_producto_permanentemente($id_producto, SessionManager $sessionManager)
   {
    producto_precio::where('id_producto',$id_producto)->delete();

    producto::withTrashed()
    ->find($id_producto)
    ->forceDelete();


    $sessionManager->flash('correcto', 'El producto ha sido eliminado exitosamente!');
    return redirect('registros_eliminados');
   }






   function reporte_producto($fecha_inicio,$fecha_fin,$parametro)
   {

    if ($parametro==1) 
    {
      
    $consulta_productos=producto::
    join('categoria','producto.id_categoria','=','categoria.id')
    ->join('unidad','producto.id_unidad','=','unidad.id')
    ->select('producto.*','categoria.*','unidad.*','producto.id as id_producto','categoria.id as id_categoria','unidad.id as id_unidad')
    ->where(function ($query) use ($parametro,$fecha_inicio,$fecha_fin){
            $query->whereBetween('producto.created_at', [$fecha_inicio, $fecha_fin]);
    })
    ->get();

    return view('paginas.tablas.tabla_productos')->with('consulta_productos',$consulta_productos);
    }

   }

}
