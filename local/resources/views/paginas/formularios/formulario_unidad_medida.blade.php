                  <div class="row">
                      <div class="input-field col s8">
                          <input type="text" class="validate" id="nombre_unidad" name="nombre" value="{{empty($consulta_unidad->uni_nombre) ? old('nombre') : $consulta_unidad->uni_nombre}}">
                          <label for="first_name">Nombre *</label>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <div class="row">
                        <div class="input-field col s8">
                          <textarea id="descripcion_unidad" name="descripcion" class="materialize-textarea">{{empty($consulta_unidad->uni_descripcion) ? old('descripcion') : $consulta_unidad->uni_descripcion}}</textarea>
                          <label for="textarea1">Descripción *</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s8">
                        <input type="checkbox"  id="test7" name="estado" value="1" />
                        <label for="test7">Activo</label>
                      </div>
                  </div>


                  @if(isset($consulta_unidad))

                    <script type="text/javascript">
                      
                    if (<?php echo $consulta_unidad->uni_estado; ?>!= 0)
                    {
                        $("#test7").prop('checked',true);
                    }

                      if (<?php echo $consulta_unidad->uni_estado; ?>!= 0)
                      {
                          $("#test7").prop('checked',true);
                      }
                    </script>
                  @else
                    <script type="text/javascript">
                      $("#test7").prop('checked',true);
                    </script>
                  @endif