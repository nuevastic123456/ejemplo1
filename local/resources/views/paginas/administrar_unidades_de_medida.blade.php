@extends('plantillas/principal')

@section('titulo_pestania', 'Administrar unidades de medida')

@section('titulo')
@parent

<h3 class="center-align">Administrar unidades de medida</h3>
@endsection
@section('contenido')
    @include('alertas.correcto')
    @include('alertas.error')
    @include('alertas.advertencia')
    @include('alertas.informacion')

    @if(count($unidades)>0)
      <!-- acciones -->
      <div class="row">
          <div class="col s12">
                <div class="input-field col s6">
                  <i class="material-icons prefix">description</i>
                  <input  id="filtro" type="text" class="validate">
                  <label for="first_name">Filtro</label>
                </div>
                <div class="col s3">
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Buscar"><i class="material-icons" onclick="filtro_busqueda(url_web+'buscar_producto/'+$('#filtro').val(),'#resultado')">search</i></a>
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Recargar pagina" href="javascript:location.reload()"><i class="material-icons">replay</i></a>
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Agregar" href="{{url('formulario_registro_unidad_medida')}}" id="agregar_unidad"><i class="material-icons" id="agregar_unidad">add</i></a>
                </div>
         </div>
      </div>

    
    <!-- tabla -->
    <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content" id="resultado">
                 @include('paginas.tablas.tabla_unidades_de_medida')
                {{ $unidades->links() }} 
            </div>
          </div>
        </div>
      </div>


                      <!-- permisos de usuario -->                  
                  <?php $permiso=false; ?>
                  @foreach(Session::get('permiso_usuario') as $row)
                    @if($row->id_permiso==1)
                          <?php 
                          $permiso=true;
                          break; 
                          ?>
                    @endif
                  @endforeach
                  @if($permiso==false)
                          <script type="text/javascript">
                             $('#agregar_unidad').addClass('disabled').removeAttr("href");
                          </script>
                  @endif

  @else
      <div class="row">
      <div class="col s8 #90caf9 blue lighten-3 card-panel" style="color:white">
          <strong><i class="tiny material-icons">done_all</i> ATENCIÓN! </strong>
          <br>
          <p>No hay unidades de medida registrados actualmente.   <a class="btn-floating btn-large waves-effect waves-light" href="{{url('formulario_registro_producto')}}"><i class="material-icons">add</i></a></p> 

      </div>
      </div>
  @endif
@endsection