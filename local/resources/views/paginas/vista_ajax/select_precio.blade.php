
  <select id="precio_producto">
   	<option value='' disabled selected>--seleccionar--</option>
   		@foreach ($precios as $registro)
		<option value='{{$registro->pre_precio_venta}}'>{{$registro->pre_precio_venta.' '.$registro->pre_descripcion}}</option>
   		@endforeach
	</select>
  <label>Precio </label>
  <p id="m_precio" class="m_validacion"></p>

<script type="text/javascript">
	  $(document).ready(function() {
    $('select').material_select();
  });  

  // para mostrar mensaje de validacion
  var m_precio=$('#m_precio');
  // el precio del producto
  var precio=$('#precio_producto');
</script>

