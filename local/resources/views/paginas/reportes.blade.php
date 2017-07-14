@extends('plantillas/principal')

@section('titulo_pestania', 'Rportes')

@section('titulo')
@parent

<h3 class="center-align">Reportes</h3>
@endsection
@section('contenido')






  <div class="row">
    <div class="col s12">
      <ul class="tabs tab-demo z-depth-1">
        <li class="tab col s3"><a class="active" href="#test1">Productos</a></li>
        <li class="tab col s3"><a href="#test2">Usuarios</a></li>
        <li class="tab col s3"><a href="#test3")">Compras</a></li>
        <li class="tab col s3"><a href="#test4">Ventas</a></li>
      </ul>
    </div>

    @include('alertas.correcto')
    @include('alertas.error')
    @include('alertas.advertencia')
    @include('alertas.informacion')



    <div id="test1" class="col s12">
    <br>
    <br>
      
                            <div class="row">
                              <div class="input-field input-group col s3">
                                  <div>
                                   <select id="reporte_producto">
                                    <option value="" disabled selected>--seleccionar--</option>
                                    <option value="1">Productos registrados</option>
                                  </select>
                                  <label>Opción de consulta</label>
                                  </div>
                              </div>

                              <div class="input-field col s3">
                                  <input type="text" class="validate from" id="fecha_inicio_producto">
                                  <label for="first_name">Desde</label>
                              </div>
                              <div class="input-field col s3" >
                                  <input type="text" class="validate to" id="fecha_fin_producto">
                                  <label for="first_name">Hasta</label>
                              </div>                          
                              </div>
                                <div class="col s4">
                                <a class="waves-effect waves-light btn" onclick="consulta_reporte('#fecha_inicio_producto','#fecha_fin_producto','#reporte_producto',url_web+'reporte_producto/'+$('#fecha_inicio_producto').val()+'/'+$('#fecha_fin_producto').val()+'/'+$('#reporte_producto').val(),'#resultado_producto')"><i class="material-icons left">done</i>Generar reporte</a>
                              </div>
                              
                                  <!-- tabla -->
                                <div class="row">
                                    <div class="col s12">
                                      <div class="card">
                                        <div class="card-content" id="resultado_producto">


                                              </div>
                                          </div>
                                    </div>
                                </div>
  
    </div>










    <div id="test2" class="col s12">
    <br>
    <br>
                            <div class="row">
                              <div class="input-field input-group col s3">
                                  <div>
                                   <select id="reporte_usuario">
                                    <option value="" disabled selected>--seleccionar--</option>
                                    <option value="1">Usuarios registrados</option>

                                  </select>
                                  <label>Opción de consulta</label>
                                  </div>
                              </div>

                              <div class="input-field col s3">
                                  <input type="text" class="validate from" id="fecha_inicio_usuario">
                                  <label for="first_name">Desde</label>
                              </div>
                              <div class="input-field col s3" >
                                  <input type="text" class="validate to" id="fecha_fin_usuario">
                                  <label for="first_name">Hasta</label>
                              </div>                          
                              </div>
                                <div class="col s4">
                                <a class="waves-effect waves-light btn" onclick="consulta_reporte('#fecha_inicio_usuario','#fecha_fin_usuario','#reporte_usuario',url_web+'reporte_usuario/'+$('#fecha_inicio_usuario').val()+'/'+$('#fecha_fin_usuario').val()+'/'+$('#reporte_usuario').val(),'#resultado_usuario')"><i class="material-icons left">done</i>Generar reporte</a>
                              </div>
                              
                                  <!-- tabla -->
                                <div class="row">
                                    <div class="col s12">
                                      <div class="card">
                                        <div class="card-content" id="resultado_usuario">


                                              </div>
                                          </div>
                                    </div>
                                </div>

    </div>





    <div id="test3" class="col s12">
    <br>
    <br>              
                  <div class="row">
                              <div class="input-field input-group col s3">
                                  <div>
                                   <select id="reporte_compra">
                                    <option value="" disabled selected>--seleccionar--</option>
                                    <option value="1">Compras hechas</option>

                                  </select>
                                  <label>Opción de consulta</label>
                                  </div>
                              </div>

                              <div class="input-field col s3">
                                  <input type="text" class="validate from" id="fecha_inicio_compra">
                                  <label for="first_name">Desde</label>
                              </div>
                              <div class="input-field col s3" >
                                  <input type="text" class="validate to" id="fecha_fin_compra">
                                  <label for="first_name">Hasta</label>
                              </div>                          
                              </div>
                                <div class="col s4">
                                <a class="waves-effect waves-light btn" onclick="consulta_reporte('#fecha_inicio_compra','#fecha_fin_compra','#reporte_compra',url_web+'reporte_compra/'+$('#fecha_inicio_compra').val()+'/'+$('#fecha_fin_compra').val()+'/'+$('#reporte_compra').val(),'#resultado_compra')"><i class="material-icons left">done</i>Generar reporte</a>
                              </div>
                              
                                  <!-- tabla -->
                                <div class="row">
                                    <div class="col s12">
                                      <div class="card">
                                        <div class="card-content" id="resultado_compra">


                                              </div>
                                          </div>
                                    </div>
                                </div>
    </div>





    <div id="test4" class="col s12">
    <br>
    <br>
                  <div class="row">
                              <div class="input-field input-group col s3">
                                  <div>
                                   <select id="reporte_venta">
                                    <option value="" disabled selected>--seleccionar--</option>
                                    <option value="1">Ventas hechas</option>

                                  </select>
                                  <label>Opción de consulta</label>
                                  </div>
                              </div>

                              <div class="input-field col s3">
                                  <input type="text" class="validate from" id="fecha_inicio_venta">
                                  <label for="first_name">Desde</label>
                              </div>
                              <div class="input-field col s3" >
                                  <input type="text" class="validate to" id="fecha_fin_venta">
                                  <label for="first_name">Hasta</label>
                              </div>                          
                              </div>
                                <div class="col s4">
                                <a class="waves-effect waves-light btn" onclick="consulta_reporte('#fecha_inicio_venta','#fecha_fin_venta','#reporte_venta',url_web+'reporte_venta/'+$('#fecha_inicio_venta').val()+'/'+$('#fecha_fin_venta').val()+'/'+$('#reporte_venta').val(),'#resultado_venta')"><i class="material-icons left">done</i>Generar reporte</a>
                              </div>
                              
                                  <!-- tabla -->
                                <div class="row">
                                    <div class="col s12">
                                      <div class="card">
                                        <div class="card-content" id="resultado_venta">


                                              </div>
                                          </div>
                                    </div>
                                </div>

    </div>
  </div>

@endsection