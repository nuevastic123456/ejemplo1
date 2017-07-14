                  <div class="row">
                      <div class="input-field col s8">
                          <input type="text" class="validate" id="nombre_categoria" name="nombre" value="{{empty($consulta_unidaad->uni_nombre) ? old('nombre') : $consulta_unidad->uni_nombre}}">
                          <label for="first_name">Nombre *</label>
                      </div>
                  </div>
                  <div class="row">
                      <div class="row">
                        <div class="input-field col s8">
                          <textarea id="descripcion_categoria" name="descripcion" class="materialize-textarea"> {{empty($consulta_categoria->cat_descripcion) ? old('descripcion') : $consulta_categoria->cat_descripcion}}</textarea>
                          <label for="textarea1">Descripción *</label>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s8">
                        <input type="checkbox" id="test6"  name="estado" value="1" />
                        <label for="test6">Activo</label>
                      </div>
                  </div>

                  @if(isset($consulta_categoria))

                    <script type="text/javascript">
                      
                    if (<?php echo $consulta_categoria->cat_estado; ?>!= 0)
                    {
                        $("#test6").prop('checked',true);
                    }

                      if (<?php echo $consulta_categoria->cat_estado; ?>!= 0)
                      {
                          $("#test6").prop('checked',true);
                      }
                    </script>
                  @else
                    <script type="text/javascript">
                      $("#test6").prop('checked',true);
                    </script>
                  @endif

