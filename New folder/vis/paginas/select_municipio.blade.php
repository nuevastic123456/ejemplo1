
     <select name="municipio" id="municipio">
   		<option value='' disabled selected>--seleccionar--</option>
   		@foreach ($departamento as $registro)
		<option value='{{$registro->id_municipio}}'>{{$registro->mun_nombre}}</option>
   		@endforeach
	</select>
    <label>Municipio *</label>

<script type="text/javascript">
	  $(document).ready(function() {
    $('select').material_select();
  });  
</script>

