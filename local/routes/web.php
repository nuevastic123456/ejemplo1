<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','login_controller@index');


Route::post('ingresar',['uses'=>'login_controller@ingresar','as'=>'login.ingresar']);


Route::group(['middleware' => 'auth'], function () {

//inicio de la pagina
Route::get('principal','inicio_controller@principal');

// cierre de sesion
Route::get('cerrar_sesion','login_controller@cerrar_sesion');

// vista lista de usuarios
Route::get('administrar_usuarios','usuario_controller@index');

// vista registro de usuarios
Route::get('formulario_registro_usuario','usuario_controller@formulario_registro');

// consulta municipios dependiendo el departamento seleccionado
Route::get('consulta_municipios/{id_departamento}','usuario_controller@consulta_municipios');

// registra datos de usuario
Route::post('registrar_usuario',['uses'=>'usuario_controller@registrar_usuario','as'=>'usuario.registrar']);

// vista editar usuario
Route::get('editar_usuario/{id_usuario}','usuario_controller@editar_usuario');


// actualiza usuario
Route::put('actualizar_usuario/{id_usuario}',['uses'=>'usuario_controller@actualizar_usuario','as'=>'usuario.actualizar']);


// vista lista de usuarios
Route::get('administrar_productos','producto_controller@index');


//filtro de usuarios
Route::get('buscar_usuario/{parametro}','usuario_controller@buscar_usuario');

//elimina usuarios temporalmente
Route::get('eliminar_usuario_temporalmente/{id_usuario}','usuario_controller@eliminar_usuario_temporalmente');

//elimina usuarios temporalmente
Route::get('lista_usuarios_eliminados','usuario_controller@lista_usuarios_eliminados');

//elimina usuarios temporalmente
Route::get('restaurar_usuario/{id_usuario}','usuario_controller@restaurar_usuario');

//elimina usuarios temporalmente
Route::get('eliminar_usuario_permanentemente/{id_usuario}','usuario_controller@eliminar_usuario_permanentemente');





// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------


// vista registro de usuarios
Route::get('formulario_registro_producto','producto_controller@formulario_registro');

// registra datos de producto
Route::post('registrar_producto',['uses'=>'producto_controller@registrar_producto','as'=>'producto.registrar']);

// vista editar producto
Route::get('editar_producto/{id_producto}','producto_controller@editar_producto');


// actualiza usuario
Route::put('actualizar_producto/{id_producto}',['uses'=>'producto_controller@actualizar_producto','as'=>'producto.actualizar']);

//filtro de usuarios
Route::get('buscar_producto/{parametro}','producto_controller@buscar_producto');


//elimina usuarios temporalmente
Route::get('eliminar_producto_temporalmente/{id_producto}','producto_controller@eliminar_producto_temporalmente');

//elimina usuarios temporalmente
Route::get('lista_productos_eliminados','producto_controller@lista_productos_eliminados');

//elimina usuarios temporalmente
Route::get('restaurar_producto/{id_producto}','producto_controller@restaurar_producto');

//elimina usuarios temporalmente
Route::get('eliminar_producto_permanentemente/{id_producto}','producto_controller@eliminar_producto_permanentemente');








// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// registro categoria por ajax
Route::get('registrar_categoria_ajax',['uses'=>'categoria_controller@registrar_categoria_ajax']);

// vista con la lista de todas las unidaes de medida registradas
Route::get('administrar_categorias','categoria_controller@index');
// vista registro de categorias
Route::get('formulario_registro_categoria','categoria_controller@formulario_registro');

// registra datos de la categoria
Route::post('registrar_categoria',['uses'=>'categoria_controller@registrar_categoria','as'=>'categoria.registrar']);

// vista editar categoria
Route::get('editar_categoria/{id_categoria}','categoria_controller@editar_categoria');

// actualizar categoria
Route::put('actualizar_categoria/{id_categoria}',['uses'=>'categoria_controller@actualizar_categoria','as'=>'categoria.actualizar']);

//elimina usuarios temporalmente
Route::get('eliminar_categoria_temporalmente/{id_categoria}','categoria_controller@eliminar_categoria_temporalmente');

//filtro de categorias
Route::get('buscar_categoria/{parametro}','categoria_controller@buscar_categoria');


//elimina usuarios temporalmente
Route::get('lista_categorias_eliminadas','categoria_controller@lista_categorias_eliminadas');

//elimina usuarios temporalmente
Route::get('restaurar_categoria/{id_categoria}','categoria_controller@restaurar_categoria');

//elimina usuarios temporalmente
Route::get('eliminar_categoria_permanentemente/{id_categoria}','categoria_controller@eliminar_categoria_permanentemente');








// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// registro unidad por ajax
Route::get('registrar_unidad_ajax',['uses'=>'unidad_controller@registrar_unidad_ajax']);

// vista con la lista de todas las unidaes de medida registradas
Route::get('administrar_unidades','unidad_controller@index');
// vista registro de unidades de medida
Route::get('formulario_registro_unidad_medida','unidad_controller@formulario_registro');

// registra datos de la unidad de medida
Route::post('registrar_unidad_medida',['uses'=>'unidad_controller@registrar_unidad_medida','as'=>'unidad_medida.registrar']);


// vista editar categoria
Route::get('editar_unidad_medida/{id_unidad}','unidad_controller@editar_unidad_medida');

// actualizar categoria
Route::put('actualizar_unidad/{id_unidad}',['uses'=>'unidad_controller@actualizar_unidad_medida','as'=>'unidad_medida.actualizar']);

//elimina usuarios temporalmente
Route::get('eliminar_unidad_temporalmente/{id_unidad}','unidad_controller@eliminar_unidad_temporalmente');

//filtro de categorias
Route::get('buscar_unidad/{parametro}','unidad_controller@buscar_unidad');

//elimina usuarios temporalmente
Route::get('lista_unidades_eliminadas','unidad_controller@lista_unidades_eliminadas');

//elimina usuarios temporalmente
Route::get('restaurar_unidad/{id_unidad}','unidad_controller@restaurar_unidad');

//elimina usuarios temporalmente
Route::get('eliminar_unidad_permanentemente/{id_unidad}','unidad_controller@eliminar_unidad_permanentemente');








// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista permisos de usuarios
Route::get('permisos_usuario',['uses'=>'permiso_usuario_controller@index']);
// dar permiso al tipo de usuario
Route::get('dar_permiso_usuario/{id_permiso}/{id_tipo_usuario}',['uses'=>'permiso_usuario_controller@dar_permiso_usuario']);

// cancelar permiso al tipo de usuario
Route::get('cancelar_permiso_usuario/{id_permiso}/{id_tipo_usuario}',['uses'=>'permiso_usuario_controller@cancelar_permiso_usuario']);





});




// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista para comprar productos
Route::get('compra','compra_controller@index');
// buscar productos por medio de un campo de texto
Route::get('busca_producto/{parametro}/{categoria}','compra_controller@busca_producto');
// consulta la cantidad actual de cada producto
Route::get('consulta_cantidad_producto/{id_producto}','compra_controller@consulta_cantidad_producto');

// registra la compra
Route::post('registrar_compra',['uses'=>'compra_controller@registrar_compra','as'=>'compra.registrar']);

Route::get('busca_proveedor/{parametro}','compra_controller@busca_proveedor');



// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista para vender productos
Route::get('venta','factura_controller@index');
Route::get('precios/{id_producto}','factura_controller@consulta_precios');

Route::get('busca_cliente/{parametro}','factura_controller@busca_cliente');
// registra la venta
Route::post('registrar_venta',['uses'=>'factura_controller@registrar_venta','as'=>'venta.registrar']);



// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista inventario
Route::get('inventario','consultas_controller@inventario');


Route::get('inventario_ajax/{parametro}','consultas_controller@inventario_ajax');






// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista inventario
Route::get('empresa','empresa_controller@index');
Route::post('guardar_datos',['uses'=>'empresa_controller@guardar_datos','as'=>'empresa.guardar_datos']);



// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista inventario
Route::get('registros_eliminados','otro_controller@index');






// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista compras hechas
Route::get('listar_compras','consultas_controller@listar_compras');

Route::get('compras_ajax/{parametro}','consultas_controller@compras_ajax');




// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista ventas hechas
Route::get('listar_ventas','consultas_controller@listar_ventas');

Route::get('ventas_ajax/{parametro}','consultas_controller@ventas_ajax');


// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// --------------------------------------------------------------------------------
// vista reportes
Route::get('reportes','otro_controller@vista_reportes');
Route::get('reporte_producto/{fecha_inicio}/{fecha_fin}/{parametro}','producto_controller@reporte_producto');
Route::get('reporte_usuario/{fecha_inicio}/{fecha_fin}/{parametro}','usuario_controller@reporte_usuario');
Route::get('reporte_compra/{fecha_inicio}/{fecha_fin}/{parametro}','consultas_controller@reporte_compra');
Route::get('reporte_venta/{fecha_inicio}/{fecha_fin}/{parametro}','consultas_controller@reporte_venta');
