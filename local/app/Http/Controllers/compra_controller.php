<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categoria;
use App\producto;
use App\detalle_factura;
use App\detalle_compra;
use App\modo_compra;
use App\pago_compra;
use App\compra;
use DB;
use App\User;
use Auth;

class compra_controller extends Controller
{
 
    private $Controller;
    public function __construct()
   {
       $this->usuario=\Auth::User();
   }

    //vista principal para realizar compra
    function index()
    {
    	$data['categorias']=categoria::get();
    	$data['modo_compra']=modo_compra::get();
    	return view('paginas/comprar',$data);
    }


    function busca_producto($parametro,$categoria)
    {
    	if ($categoria!=0)
    	{
    		$productos= producto::
    		where('id_categoria',$categoria)
	    	->where(function ($query) use ($parametro){
	            $query->where('pro_nombre','like','%'.$parametro.'%')
	        	->orWhere('pro_codigo', 'like','%'.$parametro.'%');
	        })
	        ->select('pro_nombre','id','pro_codigo')
	        ->get();
    	}
    	else
    	{
	    	$productos= producto::
	    	where(function ($query) use ($parametro){
	            $query->where('pro_nombre','like','%'.$parametro.'%')
	        	->orWhere('pro_codigo', 'like','%'.$parametro.'%');
	        })
			->select('pro_nombre','id','pro_codigo')
	        ->get();
    	}

    	return $productos;
    }


    function consulta_cantidad_producto($id_producto)
    {	
    	$cantidad_vendida=producto::join('detalle_factura','detalle_factura.id_producto','=','producto.id')
        ->select(DB::raw('SUM(df_cantidad) as total_vendido'))
        ->where('producto.id',$id_producto)
        ->first();

    	$cantidad_comprada=producto::join('detalle_compra','detalle_compra.id_producto','=','producto.id')
        ->select(DB::raw('SUM(dc_cantidad) as total_comprado'))
        ->where('producto.id',$id_producto)
        ->first();

        $producto=producto::where('producto.id',$id_producto)
        ->select('producto.pro_ruta_foto','pro_stock_maximo')
        ->first();

        $array=array('vendido' => $cantidad_vendida->total_vendido, 'comprado'=>$cantidad_comprada->total_comprado, 'imagen' =>$producto->pro_ruta_foto,'stock_maximo'=>$producto->pro_stock_maximo);

        return $array;
    }




    function registrar_compra(Request $request)
    {
        $usuario=\Auth::User();
        $compra=new compra;
        $compra->id_usuario=$usuario->id;
        $compra->id_proveedor=$request->id_proveedor;
        $compra->com_total=$request->total;
        $compra->id_modo_compra=$request->modo_compra;
        if($request->pago==$request->total) 
        {
            $compra->com_estado=1;
        }
        else
        {
            $compra->com_estado=0;
        }
        $compra->save();


        $pago_compra=new pago_compra;
        $pago_compra->id_compra=$compra->id;
        if ((int)$request->pago >= (int)$request->total) 
        {
            $pago_compra->pc_abono=$request->pago;
            $pago_compra->pc_saldo=0;
            $pago_compra->pc_estado=1;
        }
        else
        {
            $pago_compra->pc_abono=$request->pago;
            $pago_compra->pc_saldo=(int)$request->total-(int)$request->pago;
            $pago_compra->pc_estado=0;
        }
        $pago_compra->save();

        foreach (json_decode($request->compra) as $row) 
        {
            if ($row!=null) 
            {
                $detalle_compra=new detalle_compra;
                $detalle_compra->dc_cantidad=$row->cantidad;
                $detalle_compra->dc_precio=$row->valor_unitario;
                $detalle_compra->id_compra=$compra->id;
                $detalle_compra->id_producto=$row->id_producto;
                $detalle_compra->dc_estado=1;
                $detalle_compra->save();
            }
        }

        return '<strong>Se ha guardado correctamente! </strong>';
    }


    function busca_proveedor($parametro)
    {   
        $proveedores=User::where('id_tipo_usuario',3)
        ->where(function ($query) use ($parametro){
                $query->where('usu_nombre','like','%'.$parametro.'%')
                ->orWhere('usu_numero_documento', 'like','%'.$parametro.'%');
            })
        ->select('id','usu_nombre','usu_numero_documento')
        ->get();

        return $proveedores;
    }


}
