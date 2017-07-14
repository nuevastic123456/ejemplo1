
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="nombre" value="{{empty($consulta_usuario->usu_nombre) ? old('nombre') : $consulta_usuario->usu_nombre}}">
                        <label for="first_name">Nombre completo *</label>
                    </div>

                    <div class="input-field col s6">
                        <select name="tipo_documento" id="tipo_documento">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($tipo_documento as $registro)
                            <option value="{{$registro->id_tipo_documento}}">{{$registro->td_descripcion}}</option>
                          @endforeach
                        </select>
                        <label>Tipo de documento *</label>
                    </div>
                </div>

                <div class="row">
                   <div class="input-field col s6">
                        <input type="text" class="validate" name="numero_documento" value="{{empty($consulta_usuario->usu_numero_documento) ? old('numero_documento') : $consulta_usuario->usu_numero_documento}}" onkeypress="return solo_numeros(event)">
                        <label>Número de documento *</label>
                    </div>

                    <div class="input-field col s6">
                        <input type="text" class="validate" name="numero_telefonico" value="{{empty($consulta_usuario->usu_numero_telefono) ? old('numero_telefonico') : $consulta_usuario->usu_numero_telefono}}" onkeypress="return solo_numeros(event)">
                        <label>Número telefonico *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="correo_electronico" value="{{empty($consulta_usuario->email) ? old('correo_electronico') : $consulta_usuario->email}}">
                        <label>Correo electrónico</label>
                    </div>
                    <div class="input-field col s6">
                         <select name="departamento" id="departamento" onchange="cargar_municipios($(this).val())">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($departamento as $registro)
                            <option value="{{$registro->id_departamento}}">{{$registro->dep_nombre}}</option>
                          @endforeach
                        </select>
                        <label for="first_name">Departamento *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6" id="id_municipio">
                        <select name="municipio" id="municipio">
                          <option value="" disabled selected>--selecciona el departamento--</option>
                          @if(isset($consulta_usuario))
                            @foreach($municipio as $registro)
                            <option value="{{$registro->id_municipio}}">{{$registro->mun_nombre}}</option>
                            @endforeach
                          @endif
                        </select>
                        <label>Municipio *</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="direccion" value="{{empty($consulta_usuario->usu_direccion) ? old('direccion') : $consulta_usuario->usu_direccion}}">
                        <label for="first_name">Dirección *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field input-group col s6">
                         <select name="tipo_usuario" id="tipo_usuario">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($tipo_usuario as $registro)
                            <option value="{{$registro->id_tipo_usuario}}">{{$registro->tu_descripcion}}</option>
                          @endforeach
                        </select>
                        <label>Tipo de usuario *</label>
                        <span class="suffix">
                          <a title="Agregar tipo de usuario" class="btn btn-floating waves-effect waves-light #1565c0 blue darken-3">+</a>
                        </span>
                    </div>
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
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="nombre_usuario" value="{{empty($consulta_usuario->name) ? old('nombre_usuario') : $consulta_usuario->name}}">
                        <label for="first_name">Nombre de usuario *</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="password" class="validate" name="contrasenia">
                        <label>Contraseña *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                      <input type="checkbox" id="test6" name="bloqueado" value="1" />
                      <label for="test6">Bloqueado</label>
                    </div>
                </div>


@if(isset($consulta_usuario))
<script type="text/javascript">

  $("#municipio > option[value="+ <?php echo $consulta_usuario->id_municipio; ?> +"]").attr('selected',true);

  $("#tipo_documento > option[value="+ <?php echo $consulta_usuario->id_tipo_documento; ?> +"]").attr('selected',true);


  $("#tipo_usuario > option[value="+ <?php echo $consulta_usuario->id_tipo_usuario; ?> +"]").attr('selected',true);

  if (<?php echo $consulta_usuario->usu_estado; ?>!= 0)
  {
      $("#test6").prop('checked',true);
  }

  $("#departamento > option[value="+ <?php echo $consulta_usuario->id_departamento; ?> +"]").attr('selected',true);
  

</script>
@endif