@extends('plantillas/principal')

@section('titulo_pestania', 'Registros eliminados')

@section('titulo')
@parent

<h3 class="center-align">Registros eliminados</h3>
@endsection
@section('contenido')
  <div class="row">
    <div class="col s12">
      <ul class="tabs tab-demo z-depth-1">
        <li class="tab col s3"><a class="active" href="#test1" onclick="filtro_busqueda(url_web+'lista_usuarios_eliminados','#test1')">Usuarios</a></li>
        <li class="tab col s3"><a href="#test2" onclick="filtro_busqueda(url_web+'lista_productos_eliminados','#test2')">Productos</a></li>
        <li class="tab col s3"><a href="#test3" onclick="filtro_busqueda(url_web+'lista_categorias_eliminadas','#test3')">Categorias</a></li>
        <li class="tab col s3"><a href="#test4" onclick="filtro_busqueda(url_web+'lista_unidades_eliminadas','#test4')">Unidades de medida</a></li>
      </ul>
    </div>

    @include('alertas.correcto')
    @include('alertas.error')
    @include('alertas.advertencia')
    @include('alertas.informacion')

    <div id="test1" class="col s12"></div>
    <div id="test2" class="col s12"></div>
    <div id="test3" class="col s12"></div>
    <div id="test4" class="col s12"></div>
  </div>
@endsection