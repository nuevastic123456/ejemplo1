@if(count($categorias)>0)

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
                  @foreach($categorias as $registro)
                      <tr>
                        <td>{{$registro->cat_nombre}}</td>
                        <td>{{$registro->cat_descripcion}}</td>
                        <td>
                          @if($registro->cat_estado==1)
                            Activo
                          @else
                            Inactivo
                          @endif
                        </td>
                        <td>
                          <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" href="{{url('restaurar_categoria/'.$registro->id)}}" id="restaurar{{$registro->id}}"><i class="material-icons" title="Restaurar">restore</i></a>

                          <a href="{{url('eliminar_categoria_permanentemente/'.$registro->id)}}" onclick="return confirm('Seguro que deseas eliminar permanentemente la categoria?')" class="btn-floating btn-large  #e53935 red darken-1" id="eliminar{{$registro->id}}"><i class="material-icons" title="Eliminar">delete</i></a>
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
          <p>No hay categorias en la papelera de reciclaje.</p> 

      </div>
      </div>
  @endif