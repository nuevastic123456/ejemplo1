@extends('plantillas/principal')

@section('titulo_pestania', 'Editar categoria')

@section('titulo')
@parent

<h3 class="center-align">Datos de la empresa<h3>
@endsection
@section('contenido')
                    
        @include('alertas.correcto')
        @include('alertas.error')
        @include('alertas.advertencia')
        @include('alertas.informacion')

            <div class="row">
                <div class="col s6">
                    @if(!empty($empresa->emp_ruta_logo))
                         <img src="{{url($empresa->emp_ruta_logo)}}" class="responsive-img materialboxed circle left" width="100">
                    @else
                         <img src="{{url('public/img/interrogacion.png')}}" class="responsive-img materialboxed circle left" width="100">
                    @endif
                </div>
            </div>
        <div class="row">
            {!! Form::open(['route' =>'empresa.guardar_datos','class'=>'col s12','files' => true, 'method'=>'post']) !!}
                <div class="row">
                      <div class="input-field col s6">
                          <input type="text" class="validate" name="nombre" value="{{empty($empresa->emp_nombre) ? old('nombre') : $empresa->emp_nombre}}">
                          <label for="first_name">Nombre de la empresa </label>
                      </div>
                      <div class="input-field col s6">
                          <input type="text" class="validate" name="nit" value="{{empty($empresa->emp_nit) ? old('nit') : $empresa->emp_nit}}">
                          <label for="first_name">Nit </label>
                      </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s6">
                          <input type="text" class="validate" name="email" value="{{empty($empresa->emp_email) ? old('email') : $empresa->emp_email}}">
                          <label for="first_name">Correo electrónico de  la empresa </label>
                      </div>
                      <div class="input-field col s6">
                          <input type="text" class="validate" name="telefono" value="{{empty($empresa->emp_telefono) ? old('telefono') : $empresa->emp_telefono}}">
                          <label for="first_name">Telefonos de la empresa</label>
                      </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s6">
                          <input type="text" class="validate" name="propietario" value="{{empty($empresa->emp_nombre_propietario) ? old('propietario') : $empresa->emp_nombre_propietario}}">
                          <label for="first_name">Nombre del propietario</label>
                    </div>
                    <div class="file-field input-field col s6">
                      <div class="btn">
                        <span>Logo</span>
                        <input type="file" name="logo">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="row">
                        <div class="input-field col s8">
                          <textarea id="descripcion_categoria" name="descripcion" class="materialize-textarea">{{empty($empresa->emp_descripcion) ? old('nombre') : $empresa->emp_descripcion}}</textarea>
                          <label for="textarea1">Descripción </label>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                       <button class="waves-effect #1565c0 blue darken-3 btn right">Guardar <i class="zmdi zmdi-mail-send" right ></i></button>
                    </div>
                  </div>

            {!! Form::close() !!}
        </div>
@endsection