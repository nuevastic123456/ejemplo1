@extends('plantillas/principal')

@section('titulo_pestania', 'Editar usuario')

@section('titulo')
@parent

<h3 class="center-align">Editar usuario ({{$consulta_usuario->usu_nombre}})</h3>
@endsection
@section('contenido')
            <div class="row">
                <div class="col s6">
                    
                    @if(!empty($consulta_usuario->usu_ruta_foto))
                         <img src="{{url($consulta_usuario->usu_ruta_foto)}}" class="responsive-img materialboxed circle left" width="100">
                    @else
                         <img src="{{url('public/img/usuarios/usuario.png')}}" class="responsive-img materialboxed circle left" width="100">
                    @endif
                </div>
                <div class="col s6">
                    <a class="btn-floating btn-large #1565c0 blue darken-3 right" href="javascript:window.history.back();" title="volver atras"><i class="material-icons">swap_horiz</i></a>
                </div>
            </div>

            @include('alertas.valida_campos')

            <div class="row">
            {!! Form::open(['route' =>['usuario.actualizar',$consulta_usuario->id],'class'=>'col s12','files' => true, 'method'=>'put']) !!}
                
                 @include('paginas.formularios.formulario_usuario')
                <div class="row">
                    <div class="input-field col s12">
                       <button class="waves-effect #1565c0 blue darken-3 btn right">Actualizar <i class="zmdi zmdi-mail-send" right ></i></button>
                    </div>
                </div>

            {!! Form::close() !!}
            </div>

@endsection