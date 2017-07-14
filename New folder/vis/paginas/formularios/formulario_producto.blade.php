
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="nombre" value="{{old('nombre')}}">
                        <label for="first_name">Nombre *</label>
                    </div>
                     <div class="input-field col s6">
                        <input type="text" class="validate" name="codigo" value="{{old('codigo')}}">
                        <label for="first_name">Codigo *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field input-group col s6">
                         <select name="categoria">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($categoria as $registro)
                            <option value="{{$registro->id_categoria}}">{{$registro->cat_nombre}}</option>
                          @endforeach
                        </select>
                        <label>Categoria *</label>
                        <span class="suffix">
                          <a title="Agregar categoria" class="btn btn-floating waves-effect waves-light #1565c0 blue darken-3">+</a>
                        </span>
                    </div>
                    <div class="input-field input-group col s6">
                         <select name="unidad">
                          <option value="" disabled selected>--seleccionar--</option>
                          @foreach($unidad as $registro)
                            <option value="{{$registro->id_unidad}}">{{$registro->uni_descripcion}}</option>
                          @endforeach
                        </select>
                        <label>Unidad de medida *</label>
                        <span class="suffix">
                          <a title="Agregar unidad de medida" class="btn btn-floating waves-effect waves-light #1565c0 blue darken-3">+</a>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="stock_minimo" value="{{old('stock_minimo')}}">
                        <label>Stock  minimo *</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="validate" name="stock_maximo" value="{{old('stock_maximo')}}">
                        <label>Stock  maximo *</label>
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
                      <input type="checkbox" id="test6" name="bloqueado" value="1" />
                      <label for="test6">Bloqueado</label>
                    </div>
                </div>
