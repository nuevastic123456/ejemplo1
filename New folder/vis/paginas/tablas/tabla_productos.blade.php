            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Foto</th>
                      <th>Nombre</th>
                      <th>Codigo</th>
                      <th>Categoria</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($consulta_productos as $registro)
                      <tr>
                        <td>
                        <img src="{{empty($registro->pro_ruta_foto) ? url('public/img/interrogacion.png') : $registro->pro_ruta_foto}}" class="responsive-img materialboxed" width="70">
                        </td>
                        <td>{{$registro->pro_nombre}}</td>
                        <td>{{$registro->pro_codigo}}</td>
                        <td>{{$registro->cat_nombre}}</td>
                        <td>
                          @if($registro->pro_estado==1)
                            Activo
                          @else
                            Inactivo
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

