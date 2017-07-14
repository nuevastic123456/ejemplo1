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
                          <a class="btn-floating btn-large waves-effect #4caf50 green"  href="{{url('editar_unidad_medida/'.$registro->id)}}" id="editar{{$registro->id}}"><i class="material-icons" title="Editar">mode_edit</i></a>

                          <a href="{{url('eliminar_unidad_temporalmente/'.$registro->id)}}" onclick="return confirm('Seguro que deseas eliminar temporalmente el producto?')"  class="btn-floating btn-large  #e53935 red darken-1" id="eliminar{{$registro->id}}"><i class="material-icons" title="Eliminar">delete</i></a>
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

