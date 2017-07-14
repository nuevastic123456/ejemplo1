  <select name="categoria" id="categoria">
      <option value="" disabled selected>--seleccionar--</option>
      @foreach($categoria as $registro)
        <option value="{{$registro->id}}">{{$registro->cat_nombre}}</option>
      @endforeach
  </select>
  <label>Categoria *</label>
  
  <script type="text/javascript">
  	  $(document).ready(function() {
      $('select').material_select();
    });  
  </script>
