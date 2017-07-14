@if(count($consulta_usuarios)>0)
    
            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Foto</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>tipo de usuario</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($consulta_usuarios as $registro)
                      <tr>
                        <td><img src="{{empty($registro->usu_ruta_foto) ? url('public/img/interrogacion.png') : $registro->usu_ruta_foto}}" class="responsive-img materialboxed" width="70"></td>
                        <td>{{$registro->usu_nombre}}</td>
                        <td>{{$registro->email}}</td>
                        <td>{{$registro->tu_descripcion}}</td>
                        <td>
                           @if($registro->usu_estado==1)
                            <img src="{{url('public/img/bien.png')}}" alt="" title="Activo">
                          @else
                            <img src="{{url('public/img/cerrar.png')}}" alt="" title="Inactico">
                          @endif
                        </td>
                        <td>
                          <a class="btn-floating btn-large #1565c0 blue darken-3 tooltipped" href="{{url('restaurar_usuario/'.$registro->id_usuario)}}" id="restaurar{{$registro->id_usuario}}"><i class="material-icons" title="Restaurar">restore</i></a>

                          <a href="{{url('eliminar_usuario_permanentemente/'.$registro->id_usuario)}}" onclick="return confirm('Seguro que deseas eliminar permanentemente el usuario?')" class="btn-floating btn-large  #e53935 red darken-1" id="eliminar{{$registro->id_usuario}}"><i class="material-icons" title="Eliminar">delete</i></a>
                        </td>
                      </tr>


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
                                   $('#restaurar'+<?php echo $registro->id_usuario?>).addClass('disabled').removeAttr("href");
                                   $('#eliminar'+<?php echo $registro->id_usuario ?>).addClass('disabled').removeAttr("href onclick");
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
          <p>No hay usuarios en la papelera de reciclaje.</p> 

      </div>
      </div>
  @endif