            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Proveedor</th>
                      <th>Número de teléfono</th>
                      <th>Total</th>
                      <th>Pendiente por pagar</th>
                      <th>Fecha de registro</th>
                      <th>Estado de compra</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($compras as $registro)
                      <tr>
                        <td>{{$registro->usu_nombre}}</td>
                        <td>{{$registro->usu_numero_telefono}}</td>
                        <td>${{$registro->com_total}}</td>
                        <td>
                          @foreach($json as $pago)
                            @if($pago->id_compra==$registro->id_compra)
                              ${{(int)$registro->com_total-(int)$pago->pagado}}
                            @endif
                          @endforeach
                        </td>
                        <td>{{$registro->created_at}}</td>
                        <td>
                           @if($registro->com_estado==1)
                            <img src="{{url('public/img/bien.png')}}" alt="" title="Pagada">
                          @else
                            <img src="{{url('public/img/cerrar.png')}}" alt="" title="Por pagar">
                          @endif
                        </td>

                      </tr>

                  @endforeach
                </tbody>
              </table>

