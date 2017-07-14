@extends('plantillas/principal')

@section('titulo_pestania', 'Administrar usuarios')

@section('titulo')
@parent

<h3 class="center-align">Administrar usuarios</h3>
@endsection
@section('contenido')

    @include('alertas.correcto')
    @include('alertas.error')
    @include('alertas.advertencia')
    @include('alertas.informacion')

    @if(count($consulta_usuarios)>0)
        <div class="row">
            <div class="col s12">
                <div class="input-field col s6">
                  <i class="material-icons prefix">description</i>
                  <input  id="filtro" type="text" class="validate">
                  <label for="first_name">Filtro</label>
                </div>
                <div class="col s3">
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Buscar"><i class="material-icons" onclick="filtro_busqueda(url_web+'buscar_usuario/'+$('#filtro').val(),'#resultado')">search</i></a>
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Recargar pagina" href="javascript:location.reload()"><i class="material-icons">replay</i></a>
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" data-tooltip="Agregar" href="{{url('formulario_registro_usuario')}}" id="agregar_usuario" id="agregar_usuario"><i class="material-icons">add</i></a>
                </div>

                <!-- permisos de usuario -->                  
                  <?php $permiso=false; ?>
                  @foreach(Session::get('permiso_usuario') as $row)
                    @if($row->id_permiso==2)
                          <?php 
                          $permiso=true;
                          break; 
                          ?>
                    @endif
                  @endforeach
                  @if($permiso==false)
                          <script type="text/javascript">
                             $('#agregar_usuario').addClass('disabled').removeAttr("href");
                          </script>
                  @endif
           </div>
        </div>

          <div class="row">
            <div class="col s12">
              <div class="card">
                <div class="card-content" id="resultado">
                     @include('paginas.tablas.tabla_usuarios') 
                     {{ $consulta_usuarios->links() }}
                </div>
              </div>
            </div>
          </div>

        @else

        <div class="row">
        <div class="col s8 #90caf9 blue lighten-3 card-panel" style="color:white">
            <strong><i class="tiny material-icons">done_all</i> ATENCIÓN! </strong>
            <br>
            <p>No hay usuarios registrados actualmente.   <a class="btn-floating btn-large waves-effect waves-light #1565c0 blue darken-3"><i class="material-icons">add</i></a></p> 

        </div>
        </div>  
              
        @endif
            



@endsection