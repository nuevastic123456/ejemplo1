
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="nombre" value="{{empty($consulta_producto->pro_nombre) ? old('nombre') : $consulta_producto->pro_nombre}}">
                        <label for="first_name">Nombre *</label>
                    </div>
                     <div class="input-field col s6">
                        <input type="text" class="validate" name="codigo" value="{{empty($consulta_producto->pro_codigo) ? old('codigo') : $consulta_producto->pro_codigo}}" onkeypress="return solo_numeros(event)">
                        <label for="first_name">Codigo *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field input-group col s6">
                        <div id="id_categoria">
                         <select name="categoria" id="categoria">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($categoria as $registro)
                            <option value="{{$registro->id}}">{{$registro->cat_nombre}}</option>
                          @endforeach
                        </select>
                        <label>Categoria *</label>
                        </div>
                        <span class="suffix">
                          <a data-tooltip="Agregar categoria" href="#modal_categoria" class="tooltipped btn btn-floating waves-effect waves-light #1565c0 blue darken-3 modal-trigger">+</a>
                        </span>
                    </div>
                    <div class="input-field input-group col s6">
                        <div id="id_unidad">
                         <select name="unidad" id="unidad">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($unidad as $registro)
                            <option value="{{$registro->id}}">{{$registro->uni_nombre}}</option>
                          @endforeach
                        </select>
                        <label>Unidad de medida *</label>
                        </div>
                        <span class="suffix">
                          <a data-tooltip="Agregar unidad de medida" href="#modal_unidad" class="tooltipped btn btn-floating waves-effect waves-light #1565c0 blue darken-3 modal-trigger">+</a>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="stock_minimo" value="{{empty($consulta_producto->pro_stock_minimo) ? old('stock_minimo') : $consulta_producto->pro_stock_minimo}}" onkeypress="return solo_numeros(event)">
                        <label>Stock  mínimo *</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="stock_maximo" value="{{empty($consulta_producto->pro_stock_maximo) ? old('stock_maximo') : $consulta_producto->pro_stock_maximo}}" onkeypress="return solo_numeros(event)">
                        <label>Stock  máximo *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s6">
                      <div class="btn">
                        <span>Foto</span>
                        <input type="file" name="foto">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                      </div>
                    </div>
                </div>
                


                <div class="row">
                    <div class="input-field col s12">
                      <input type="checkbox" id="test5" checked="checked" name="estado" value="1" />
                      <label for="test5">Activo</label>
                    </div>
                </div>

                <br>
                <br>
                <br>
                <br>

                <input type="hidden" name="input_precio" id="input_precio">
                <div class="row">
                    <div class="input-field col s4">
                        <input type="text" class="validate" id="precio" onkeypress="return solo_numeros(event)">
                        <label>Precio</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" class="validate" id="descripcion_precio" >
                        <label>Descripción del precio</label>
                    </div>
                    <div class="input-field col s4">
                        <a data-tooltip="Agregar precio" onclick="agregar_precio()" class="tooltipped btn btn-floating waves-effect waves-light #1565c0 blue darken-3 ">+</a>                    
                    </div>
                </div>
                <div class="row">
                  <div class="col s8" id="lista_precio"  style="display: none;">
                    <table class="striped">
                      <thead>
                        <tr>
                          <th>Precio</th>
                          <th>Descripcion</th>
                        </tr>
                      </thead>
                      <tbody id="registro_precio">

                      </tbody>
                    </table>
                  </div>
                </div>


                @if (old('categoria'))
                  <script type="text/javascript">
                    $("#categoria > option[value="+ <?php echo old('categoria'); ?> +"]").attr('selected',true);
                  </script>
                @endif

                @if (old('unidad'))
                  <script type="text/javascript">
                    $("#unidad > option[value="+ <?php echo old('unidad'); ?> +"]").attr('selected',true);
                  </script>
                @endif

                @if(isset($consulta_producto))
                <script type="text/javascript">

                  $("#categoria > option[value="+ <?php echo $consulta_producto->id_categoria; ?> +"]").attr('selected',true);

                  $("#unidad > option[value="+ <?php echo $consulta_producto->id_unidad; ?> +"]").attr('selected',true);


                  if (<?php echo $consulta_producto->pro_estado; ?>!= 0)
                  {
                      $("#test6").prop('checked',true);
                  }
                  
                </script>

                @endif
                              