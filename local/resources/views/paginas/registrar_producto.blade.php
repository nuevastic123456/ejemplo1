@extends('plantillas/principal')

@section('titulo_pestania', 'Registrar productos')

@section('titulo')
@parent

<h3 class="center-align">Registro de productos</h3>
@endsection
@section('contenido')
        <a class="btn-floating btn-large #1565c0 blue darken-3 right tooltipped" href="javascript:window.history.back();" data-tooltip="volver atras"><i class="material-icons">swap_horiz</i></a>
            
        @include('alertas.valida_campos')
        
        <div class="row">
            {!! Form::open(['route' => 'producto.registrar','class'=>'col s12','files' => true, 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

                @include('paginas.formularios.formulario_producto')
                <div class="row">
                    <div class="input-field col s12">
                       <button class="waves-effect #1565c0 blue darken-3 btn right">Registrar <i class="zmdi zmdi-mail-send" right ></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        
        @include('paginas.modals_formulario_producto')
@endsection