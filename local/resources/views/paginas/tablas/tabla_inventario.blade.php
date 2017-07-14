            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Foto</th>
                      <th>Nombre</th>
                      <th>Codigo</th>
                      <th>Categoría</th>
                      <th>Cantidad actual</th>
                      <th>Stock mínimo</th>
                      <th>Stock máximo</th>
                      <th>Cantidad vendida</th>
                      <th>Cantidad comprada</th>
                      <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($productos as $registro)
                      <tr>
                        <td>
                        <img src="{{empty($registro->imagen) ? url('public/img/interrogacion.png') : $registro->imagen}}" class="responsive-img materialboxed" width="70">
                        </td>
                        <td>{{$registro->nombre_producto}}</td>
                        <td>{{$registro->codigo}}</td>
                        <td>{{$registro->categoria}}</td>
                        <td>{{$registro->cantidad_actual}}</td>
                        <td>{{$registro->stock_minimo}}</td>
                        <td>{{$registro->stock_maximo}}</td>
                        <td>{{$registro->cantidad_vendida}}</td>
                        <td>{{$registro->cantidad_comprada}}</td>
                        <td>
                           @if($registro->estado==1)
                            <img src="{{url('public/img/bien.png')}}" alt="" title="Activo">
                          @else
                            <img src="{{url('public/img/cerrar.png')}}" alt="" title="Inactico">
                          @endif
                        </td>
                        <td>

                      </tr>

                  @endforeach
                </tbody>
              </table>

