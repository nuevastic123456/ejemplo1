@extends('plantillas/principal')

@section('titulo_pestania', 'Editar categoria')

@section('titulo')
@parent

<h3 class="center-align">Editar categoria ({{$consulta_categoria->cat_nombre}})</h3>
@endsection
@section('contenido')
            <a class="btn-floating btn-large #1565c0 blue darken-3 right tooltipped" href="javascript:window.history.back();" data-tooltip="volver atras"><i class="material-icons">swap_horiz</i></a>
            
            @include('alertas.valida_campos')
        
        <div class="row">
            {!! Form::open(['route' =>['categoria.actualizar',$consulta_categoria->id],'class'=>'col s12','files' => true, 'method'=>'put']) !!}

                @include('paginas.formularios.formulario_categoria')
                <div class="row">
                    <div class="input-field col s12">
                       <button class="waves-effect #1565c0 blue darken-3 btn right">Actualizar <i class="zmdi zmdi-mail-send" right ></i></button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
@endsection