@extends('plantillas/principal')

@section('titulo_pestania', 'Realizar compra')

@section('titulo')
@parent

<h3 class="center-align">Realizar compra</h3>
@endsection
@section('contenido')

    @include('alertas.correcto')
    @include('alertas.error')
    @include('alertas.advertencia')
    @include('alertas.informacion')

<div class="row">
	<div class="col s12">
       <div class="row">
	
	<input type="hidden" id="id_producto">
	<input type="hidden" id="nombre_producto">
	<input type="hidden" id="cantidad_producto">
	<input type="hidden" id="imagen_producto">
	<input type="hidden" id="total_compra">
	<input type="hidden" id="stock_maximo">

	<div class="input-field col s3">
    <select id="categoria">
      <option value="0" selected>Todas las categorias</option>
      @foreach($categorias as $row)
		      <option value="{{$row->id}}">{{$row->cat_nombre}}</option>
      @endforeach
    </select>
    <label>Categoria</label>
    </div>

    	<div class="input-field col s3 ui-widget">
          <i class="material-icons prefix">toc</i>
          <input id="filtro" type="text" class="validate">
          <label for="filtro">Nombre o codigo</label>
          <p id="m_filtro" class="m_validacion"></p>
        </div>

        <div class="input-field col s3">
          <i class="material-icons prefix">assignment</i>
          <input id="precio" type="text" class="validate" onkeypress="return solo_numeros(event)">
          <label for="precio">Precio unidad</label>
          <p id="m_precio" class="m_validacion"></p>
        </div>
        <div class="input-field col s3">
          <i class="material-icons prefix">library_add</i>
          <input id="cantidad" type="number" class="validate" min="1"> 
          <label for="cantidad">Cantidad</label>
          <p id="m_cantidad" class="m_validacion"></p>
        </div>
		</div>   
	</div>	
</div>
<div class="row">
	    <div class="col s3">
			<a class="waves-effect waves-light btn" onclick="agregar_compra()"><i class="material-icons left">done</i>Agregar</a>
        </div>
        <div id="cargar" class="col s3"></div>
</div>



<div class="row" id="t_compra" style="display: none;">
	<div class="row">
	<div class="col s12">
	   <div class="card">
            <div class="card-content">
		<table class="striped responsive-table" >
			<thead>
				<th>#</th>
				<th>Foto</th>
				<th>Nombre</th>
				<th>Cantidad actual</th>
				<th>Cantidad comprada</th>
				<th>Cantidad total</th>
				<th>valor unitario</th>
				<th>Subtotal</th>
				<th>Acciones</th>
			</thead>
			<tbody id="tabla_compra">
				
			</tbody>
		</table>
		</div>
	  </div>
	</div>
	</div>


	<div class="row" style="margin-top: 50px">

		<div class="col s3">
			<h5><strong id="total"></strong></h5>
		</div>

		<input type="hidden" name="_token" value="{{csrf_token()}}" id="token">

		<div class="input-field col s3" >
		    <select id="modo_compra" style="display:none">
		      <option value="" disabled selected>--seleccionar--</option>
		      @foreach($modo_compra as $row)
				      <option value="{{$row->id}}">{{$row->mc_nombre}}</option>
		      @endforeach
		    </select>
		    <label>Modo de compra</label>
		    <p id="m_modo_compra" class="m_validacion"></p>
		</div>

    	<div class="input-field col s3">
          <i class="material-icons prefix">credit_card</i>
          <input id="pago" type="text" class="validate" onkeypress="return solo_numeros(event)">
          <label for="pago" id="label_pago">Paga con</label>
          <p id="m_pago" class="m_validacion"></p>
        </div>
	    

	    <input type="hidden" id="id_proveedor">
	    <div class="input-field col s3 ui-widget">
          <i class="material-icons prefix">perm_identity</i>
          <input id="proveedor" type="text" class="validate">
          <label for="proveedor">Proveedor</label>
          <p id="m_proveedor" class="m_validacion"></p>
        </div>
		</div>


<div class="row">
	    <div class="col s3">
			<a class="waves-effect  btn #e53935 red darken-1" onclick="cancelar_compra()"><i class="material-icons left">delete</i>Cancelar compra</a>
        </div>

       <div class="col s3">
			<a class="waves-effect btn " onclick="confirmar_compra()"><i class="material-icons left">done</i>Confirmar compra</a>
        </div>
</div>

</div>


{!!Html::script('public/js/compra.js')!!}

@endsection