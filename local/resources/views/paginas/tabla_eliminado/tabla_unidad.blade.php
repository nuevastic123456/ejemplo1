@if(count($unidades)>0)

            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($unidades as $registro)
                      <tr>
                        <td>{{$registro->uni_nombre}}</td>
                        <td>{{$registro->uni_descripcion}}</td>
                        <td>
                          @if($registro->uni_estado==1)
                            Activo
                          @else
                            Inactivo
                          @endif
                        </td>
                        <td>
                         <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" href="{{url('restaurar_unidad/'.$registro->id)}}" id="restaurar{{$registro->id}}"><i class="material-icons" title="Restaurar">restore</i></a>

                          <a href="{{url('eliminar_unidad_permanentemente/'.$registro->id)}}" onclick="return confirm('Seguro que deseas eliminar permanentemente la unidad de medida?')" class="btn-floating btn-large  #e53935 red darken-1" id="eliminar{{$registro->id}}"><i class="material-icons" title="Eliminar">delete</i></a>
                        </td>
                      </tr>

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
                             $('#restaurar'+<?php echo $registro->id?>).addClass('disabled').removeAttr("href");
                             $('#eliminar'+<?php echo $registro->id?>).addClass('disabled').removeAttr("href onclick");
                          </script>
                  @endif
                  @endforeach
                </tbody>
              </table>

  @else
      <div class="row">
      <div class="col s8 #90caf9 blue lighten-3 card-panel" style="color:white">
          <strong><i class="tiny material-icons">done_all</i> ATENCIÓN! </strong>
          <br>
          <p>No hay unidades de medida registradas actualmente.</p> 

      </div>
      </div>
  @endif