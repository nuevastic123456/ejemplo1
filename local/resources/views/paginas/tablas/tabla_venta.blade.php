            <table class="highlight responsive-table">
                <thead>
                  <tr>
                      <th>Cliente</th>
                      <th>Número de teléfono</th>
                      <th>Total</th>
                      <th>Valor por pagar</th>
                      <th>Fecha de registro</th>
                      <th>Estado de compra</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ventas as $registro)
                      <tr>
                        <td>{{$registro->usu_nombre}}</td>
                        <td>{{$registro->usu_numero_telefono}}</td>
                        <td>${{$registro->fac_total}}</td>
                        <td>
                          @foreach($json as $pago)
                            @if($pago->id_factura==$registro->id_factura)
                              ${{(int)$registro->fac_total-(int)$pago->pagado}}
                            @endif
                          @endforeach
                        </td>
                        <td>{{$registro->created_at}}</td>
                        <td>
                           @if($registro->fac_estado==1)
                            <img src="{{url('public/img/bien.png')}}" alt="" title="Pagada">
                          @else
                            <img src="{{url('public/img/cerrar.png')}}" alt="" title="Por pagar">
                          @endif
                        </td>

                      </tr>

                  @endforeach
                </tbody>
              </table>