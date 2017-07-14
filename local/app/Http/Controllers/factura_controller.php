<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modo_factura;
use App\categoria;
use App\precio;
use App\producto_precio;
use App\producto;
use App\User;
use App\factura;
use App\pago_factura;
use App\detalle_factura;

class factura_controller extends Controller
{
    //vista principal para realizar venta
    function index()
    {
    	$data['categorias']=categoria::get();
    	$data['modo_factura']=modo_factura::get();
    	return view('paginas/vender',$data);
    }


    // -------------------------------------------------------------
   // carga select con precios del producto. uso ajax
   function consulta_precios($id_producto)
   {
    	$precios=producto::join('producto_precio','producto_precio.id_producto','=','producto.id')
    	->join('precio','producto_precio.id_precio','=','precio.id')
    	->where('producto.id',$id_producto)
    	->get();
   		return view('paginas.vista_ajax.select_precio')->with('precios',$precios);
   }


function busca_cliente($parametro)
{   
        $clientes=User::where('id_tipo_usuario',4)
        ->where(function ($query) use ($parametro){
                $query->where('usu_nombre','like','%'.$parametro.'%')
                ->orWhere('usu_numero_documento', 'like','%'.$parametro.'%');
            })
        ->select('id','usu_nombre','usu_numero_documento')
        ->get();

        return $clientes;
}





  function registrar_venta(Request $request)
    {
        $usuario=\Auth::User();
        $venta=new factura;
        $venta->id_usuario_vendedor=$usuario->id;
        $venta->id_usuario_cliente=$request->id_cliente;
        $venta->fac_total=$request->total;
        $venta->id_modo_factura=$request->modo_venta;
        if($request->pago==$request->total) 
        {
            $venta->fac_estado=1;
        }
        else
        {
            $venta->fac_estado=0;
        }
        $venta->save();


        $pago_factura=new pago_factura;
        $pago_factura->id_factura=$venta->id;
        if ((int)$request->pago >= (int)$request->total) 
        {
            $pago_factura->pf_abono=0;
            $pago_factura->pf_saldo=0;
            $pago_factura->pf_estado=1;
        }
        else
        {
            $pago_factura->pf_abono=$request->pago;
            $pago_factura->pf_saldo=(int)$request->total-(int)$request->pago;
            $pago_factura->pf_estado=0;
        }
        $pago_factura->save();

        foreach (json_decode($request->venta) as $row) 
        {
            if ($row!=null) 
            {
                $detalle_factura=new detalle_factura;
                $detalle_factura->df_cantidad=$row->cantidad;
                $detalle_factura->df_precio=$row->valor_unitario;
                $detalle_factura->id_factura=$venta->id;
                $detalle_factura->id_producto=$row->id_producto;
                $detalle_factura->df_estado=1;
                $detalle_factura->save();
            }
        }

        return '<strong>Se ha guardado correctamente! </strong>';
    }



}