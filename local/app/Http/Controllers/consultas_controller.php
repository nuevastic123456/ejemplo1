<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detalle_factura;
use App\detalle_compra;
use App\producto;
use App\compra;
use App\modo_compra;
use App\pago_compra;
use App\User;
use App\factura;
use App\modo_factura;
use App\pago_factura;





class consultas_controller extends Controller
{
    
    // vista del  inventario de productos
    function consulta_inventario($productos)
    {

    	$detalle_compra=detalle_compra::get();
		$detalle_factura=detalle_factura::get();

		$array=array();


		foreach ($productos as $row_producto) 
		{

			$cantidad_actual=0;
			$acumulador_compra=0;
			$acumulador_factura=0;

			foreach ($detalle_compra as $row_compra) 
			{

				if ($row_compra->id_producto==$row_producto->id) 
				{
					$acumulador_compra=$acumulador_compra+(int)$row_compra->dc_cantidad;
				}

			}

			foreach ($detalle_factura as $row_factura) 
			{

				if ($row_compra->id_producto==$row_producto->id) 
				{
					$acumulador_factura=$acumulador_factura+(int)$row_factura->df_cantidad;
				}	

			}

			$cantidad_actual=$acumulador_compra-$acumulador_factura;

			$array[]=array('id_producto'=>$row_producto->id,'nombre_producto'=>$row_producto->pro_nombre,'codigo'=>$row_producto->pro_codigo,'cantidad_actual'=>$cantidad_actual,'stock_maximo'=>$row_producto->pro_stock_maximo,'stock_minimo'=>$row_producto->pro_stock_minimo,'imagen'=>$row_producto->pro_ruta_foto,'categoria'=>$row_producto->cat_nombre,'estado'=>$row_producto->pro_estado,'cantidad_vendida'=>$acumulador_factura,'cantidad_comprada'=>$acumulador_compra);
		}

		$json= json_encode($array);
		return json_decode($json);
    }





    function inventario()
    {
    	$productos=producto::join('categoria','producto.id_categoria','=','categoria.id')
    	->select('producto.id','producto.pro_nombre','producto.pro_codigo','producto.pro_stock_maximo','producto.pro_stock_minimo','producto.pro_ruta_foto','categoria.cat_nombre','producto.pro_estado')
    	->orderby('producto.id','desc')

    	->get();

    	$consulta_inventario=$this->consulta_inventario($productos);
    	
    	return view('paginas.inventario')->with('productos',$consulta_inventario);
    }



    function inventario_ajax($parametro)
    {
    	$productos=producto::join('categoria','producto.id_categoria','=','categoria.id')
    	->select('producto.id','producto.pro_nombre','producto.pro_codigo','producto.pro_stock_maximo','producto.pro_stock_minimo','producto.pro_ruta_foto','categoria.cat_nombre','producto.pro_estado')
    	->where(function ($query) use ($parametro){
            $query->where('producto.pro_nombre','like','%'.$parametro.'%')
        ->orWhere('producto.pro_codigo','like','%'.$parametro.'%')
        ->orWhere('categoria.cat_nombre','like','%'.$parametro.'%');
    	})
    	->orderby('producto.id','desc')
    	->get();

    	$consulta_inventario=$this->consulta_inventario($productos);
    	
    	return view('paginas.tablas.tabla_inventario')->with('productos',$consulta_inventario);
    }





    function consulta_compras($compras)
    {

    	$pago_compra=pago_compra::get();
    	
    	$array=array();

    	foreach ($compras as $row_compra) 
    	{
    		$acumulador_compra=0;

    		foreach ($pago_compra as $row_pago) 
    		{
    			if ($row_compra->id_compra==$row_pago->id_compra) 
    			{
    				$acumulador_compra=$acumulador_compra+(int)$row_pago->pc_abono;
    			}
    		}

    		$array[]=array('id_compra'=>$row_compra->id_compra,'pagado'=>$acumulador_compra);
    	}

    	$json=json_encode($array);
    	

    	return json_decode($json);
    }






    function listar_compras()
    {
    	$data['compras']=compra::join('modo_compra','compra.id_modo_compra','=','modo_compra.id')
    	->join('users','compra.id_proveedor','=','users.id')
    	->select('compra.*','modo_compra.*','users.*','compra.id as id_compra')
    	->orderby('compra.id','desc')
    	->get();

    	$data['json']=$this->consulta_compras($data['compras']);

    	return view('paginas.compras_hechas',$data);
    }







    function compras_ajax($parametro)
    {

    	$data['compras']=compra::join('modo_compra','compra.id_modo_compra','=','modo_compra.id')
    	->join('users','compra.id_proveedor','=','users.id')
    	->select('compra.*','modo_compra.*','users.*','compra.id as id_compra')
    	->where(function ($query) use ($parametro){
            $query->where('usu_nombre','like','%'.$parametro.'%')
        ->orWhere('compra.created_at','like','%'.$parametro.'%');
    	})
    	->get();

    	$data['json']=$this->consulta_compras($data['compras']);

    	return view('paginas.tablas.tabla_compra',$data);

    }












    function consulta_ventas($ventas)
    {

    	$pago_factura=pago_factura::get();
    	
    	$array=array();

    	foreach ($ventas as $row_venta) 
    	{
    		$acumulador_venta=0;

    		foreach ($pago_factura as $row_pago) 
    		{
    			if ($row_venta->id_factura==$row_pago->id_factura) 
    			{
    				$acumulador_venta=$acumulador_venta+(int)$row_pago->pf_abono;
    			}
    		}

    		$array[]=array('id_factura'=>$row_venta->id_factura,'pagado'=>$acumulador_venta);
    	}

    	$json=json_encode($array);
    	

    	return json_decode($json);
    }






    function listar_ventas()
    {
    	$data['ventas']=factura::join('modo_factura','factura.id_modo_factura','=','modo_factura.id')
    	->join('users','factura.id_usuario_cliente','=','users.id')
    	->select('factura.*','modo_factura.*','users.*','factura.id as id_factura')
    	->get();

    	$data['json']=$this->consulta_ventas($data['ventas']);

    	return view('paginas.ventas_hechas',$data);
    }



    function ventas_ajax($parametro)
    {

    	$data['ventas']=factura::join('modo_factura','factura.id_modo_factura','=','modo_factura.id')
    	->join('users','factura.id_usuario_cliente','=','users.id')
    	->select('factura.*','modo_factura.*','users.*','factura.id as id_factura')
    	->where(function ($query) use ($parametro){
            $query->where('usu_nombre','like','%'.$parametro.'%')
        ->orWhere('factura.created_at','like','%'.$parametro.'%');
    	})
    	->get();

    	$data['json']=$this->consulta_ventas($data['ventas']);

    	return view('paginas.tablas.tabla_venta',$data);

    }








   function reporte_compra($fecha_inicio,$fecha_fin,$parametro)
   {

    if ($parametro==1) 
    {

    $data['compras']=compra::join('modo_compra','compra.id_modo_compra','=','modo_compra.id')
        ->join('users','compra.id_proveedor','=','users.id')
        ->select('compra.*','modo_compra.*','users.*','compra.id as id_compra')
            ->where(function ($query) use ($parametro,$fecha_inicio,$fecha_fin){
            $query->whereBetween('compra.created_at', [$fecha_inicio, $fecha_fin]);

        })
    ->get();

        $data['json']=$this->consulta_compras($data['compras']);

        return view('paginas.tablas.tabla_compra',$data);
   }

 }






    function reporte_venta($fecha_inicio,$fecha_fin,$parametro)
   {

    if ($parametro==1) 
    {

        $data['ventas']=factura::join('modo_factura','factura.id_modo_factura','=','modo_factura.id')
        ->join('users','factura.id_usuario_cliente','=','users.id')
        ->select('factura.*','modo_factura.*','users.*','factura.id as id_factura')
        ->where(function ($query) use ($parametro,$fecha_inicio,$fecha_fin){
            $query->whereBetween('factura.created_at', [$fecha_inicio, $fecha_fin]);

        })
        ->get();

        $data['json']=$this->consulta_ventas($data['ventas']);

        return view('paginas.tablas.tabla_venta',$data);

   }

 }


}
