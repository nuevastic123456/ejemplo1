@extends('plantillas/principal')

@section('titulo_pestania', 'Permisos usuario')

@section('titulo')
@parent

<h3 class="center-align">Permisos de usuario</h3>
@endsection
@section('contenido')
    <!-- acciones -->
    <div class="row">
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped right" data-tooltip="Recargar pagina" href="javascript:location.reload()"><i class="material-icons">replay</i></a>
                
                <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped right" data-tooltip="Agregar" href="{{url('formulario_registro_producto')}}"><i class="material-icons">add</i></a>
    </div>

    <!-- tabla -->
	  <div class="row">
        <div class="col s12">
          <div class="card">
            <div class="card-content" id="resultado">
             <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Tipo de usuario</th>
                      <th>Usuario del sistema ?</th>
                      <th>Permisos</th>
                      <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tipo_usuario as $registro)
                      <tr>
                        <td>{{$registro->tu_descripcion}}</td>
                        <td>
                          @if($registro->tu_sistema==1)
                            <img src="{{url('public/img/bien.png')}}" alt="">
                          @else
                            <img src="{{url('public/img/cerrar.png')}}" alt="">
                          @endif
                        </td>
                        <td>
                        @if($registro->tu_sistema==1)
                            @foreach($permisos as $row)
                              <p>
                                <input type="checkbox" id="test{{$row->id.$registro->id}}" class="filled-in" onclick="dar_permiso({{$registro->id}},{{$row->id}})" />
                                <label for="test{{$row->id.$registro->id}}">{{$row->per_descripcion}}</label>
                              </p>
                              @foreach($permisos_usuario as $seleccionado)
                                @if($seleccionado->id_permiso == $row->id && $seleccionado->id_tipo_usuario==$registro->id)
                                  <script type="text/javascript">
                                    $('#test'+<?php echo $row->id.$registro->id; ?>).prop('checked',true);
                                  </script>
                                @endif
                              @endforeach
                            @endforeach
                        @endif
                        </td>
                        <td>
                          <a class="btn-floating btn-large waves-effect #4caf50 green" href="{{url('editar_producto/'.$registro->id_producto)}}"><i class="material-icons" title="Editar">mode_edit</i></a>

                          <a href="{{url('eliminar_producto_temporalmente/'.$registro->id_producto)}}" onclick="return confirm('Seguro que deseas eliminar temporalmente el producto?')"  class="btn-floating btn-large  #e53935 red darken-1"><i class="material-icons" title="Eliminar">delete</i></a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>

              {{ $tipo_usuario->links() }} 
            </div>
          </div>
        </div>
      </div>
@endsection