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
                          <a class="btn-floating btn-large waves-effect #4caf50 green" href="{{url('editar_categoria/'.$registro->id)}}" id="editar{{$registro->id}}"><i class="material-icons" title="Editar">mode_edit</i></a>

                          <a href="{{url('eliminar_categoria_temporalmente/'.$registro->id)}}" id="eliminar{{$registro->id}}" onclick="return confirm('Seguro que deseas eliminar temporalmente la categoria?')"  class="btn-floating btn-large  #e53935 red darken-1"><i class="material-icons" title="Eliminar">delete</i></a>
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
                             $('#editar'+<?php echo $registro->id?>).addClass('disabled').removeAttr("href");
                             $('#eliminar'+<?php echo $registro->id?>).addClass('disabled').removeAttr("href onclick");
                          </script>
                  @endif
                  @endforeach
                </tbody>
              </table>

