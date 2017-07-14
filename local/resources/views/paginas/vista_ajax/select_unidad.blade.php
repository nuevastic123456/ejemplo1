  <select name="unidad" id="unidad">
      <option value="" disabled selected>--seleccionar--</option>
      @foreach($unidad as $registro)
        <option value="{{$registro->id}}">{{$registro->uni_nombre}}</option>
      @endforeach
  </select>
  <label>Unidad de medida *</label>
  
  <script type="text/javascript">
  	  $(document).ready(function() {
      $('select').material_select();
    });  
  </script>
