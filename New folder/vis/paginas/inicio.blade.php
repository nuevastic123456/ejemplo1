@extends('plantillas/principal')

@section('title', 'Inicio')

@section('titulo')
@parent
<h3 class="center-align">Inicio</h3>
@endsection

@section('contenido')


                <div class="full-width center-align" style="margin: 40px 0;">
                    <div class="tile">
                        <div class="tile-icon"><i class="material-icons">description</i></div>
                        <div class="tile-caption">
                            <span class="center-align">Inventario</span>
                            <p class="center-align">8 productos</p>   
                        </div>
                        <a href="#" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                    <div class="tile">
                        <div class="tile-icon"><i class="zmdi zmdi-shopping-cart"></i></div>
                        <div class="tile-caption">
                            <span class="center-align">Facturar</span>
                            <p class="center-align">8 clientes</p>   
                        </div>
                        <a href="#" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                    <div class="tile">
                        <div class="tile-icon"><i class="zmdi zmdi-card"></i></div>
                        <div class="tile-caption">
                            <span class="center-align">Cartera</span>
                            <p class="center-align">8 facturas por cobrar</p>   
                        </div>
                        <a href="#" class="tile-link waves-effect waves-light">View Details &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                    <div class="tile">
                        <div class="tile-icon"><i class="material-icons">equalizer</i></div>
                        <div class="tile-caption">
                            <span class="center-align">Reportes</span>
                            <p class="center-align">Escoge el tipo de reporte</p>   
                        </div>
                        <a href="#" class="tile-link waves-effect waves-light">Ver detalles &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                    <div class="tile">
                        <div class="tile-icon"><i class="material-icons">loyalty</i></div>
                        <div class="tile-caption">
                            <span class="center-align">Por pagar</span>
                            <p class="center-align">8 facturas por pagar</p>   
                        </div>
                        <a href="#" class="tile-link waves-effect waves-light">Ver <detalles></detalles> &nbsp; <i class="zmdi zmdi-caret-right-circle"></i></a>
                    </div>
                </div> 



@endsection