@extends('plantillas/principal')

@section('titulo_pestania', 'Registrar usuarios')

@section('titulo')
@parent

<h3 class="center-align">Registro de usuarios</h3>
@endsection
@section('contenido')
            <a class="btn-floating btn-large #1565c0 blue darken-3 right" href="javascript:window.history.back();" title="volver atras"><i class="material-icons">swap_horiz</i></a>
            
            @include('alertas.valida_campos')

            {!! Form::open(['route' => 'usuario.registrar','class'=>'col s12','files' => true, 'method'=>'post', 'enctype'=>'multipart/form-data']) !!}

                @include('paginas.formularios.formulario_usuario')
                <div class="row">
                    <div class="input-field col s12">
                       <button class="waves-effect #1565c0 blue darken-3 btn right">Registrar <i class="zmdi zmdi-mail-send" right ></i></button>
                    </div>
                </div>
            {!! Form::close() !!}


@endsection