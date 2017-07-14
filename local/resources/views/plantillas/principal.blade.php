<!-- 
* Copyright 2016 Carlos Eduardo Alfaro Orellana
-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" href="{{url('public/img/rayo-fino.ico')}}" type="image/vnd.microsoft.icon">
  <title>Boltrex - @yield('titulo_pestania')</title>
    
     <!-- Normalize CSS -->
    {!!Html::style('public/plantilla/css/normalize.css')!!}
   
     <!-- Materialize CSS -->
    {!!Html::style('public/plantilla/css/materialize.min.css')!!}
  
     <!-- Material Design Iconic Font CSS -->
    {!!Html::style('public/plantilla/css/material-design-iconic-font.min.css')!!}

    <!-- Malihu jQuery custom content scroller CSS -->
    {!!Html::style('public/plantilla/css/jquery.mCustomScrollbar.css')!!}

    <!-- Sweet Alert CSS -->
    {!!Html::style('public/plantilla/css/sweetalert.css')!!}

    <!-- MaterialDark CSS -->
    {!!Html::style('public/plantilla/css/style.css')!!}

    {!!Html::style('public/materialize/css/icon.css')!!}

    <!-- jQuery -->
    {!!Html::script('public/js/jquery.min.js')!!}

    {!!Html::style('public/css/jquery-ui.css')!!}

    {!!Html::script('public/js/jquery-ui.js')!!}

    {!!Html::style('public/css/estilos.css')!!}

</head>
<body>
    <!-- Nav Lateral -->
    <section class="NavLateral full-width">
        <div class="NavLateral-FontMenu full-width ShowHideMenu"></div>
        <div class="NavLateral-content full-width">
            <header class="NavLateral-title full-width center-align">

                    @if(count(Session::get('empresa'))>0)
                         <img src="{{url(Session::get('empresa')->emp_ruta_logo)}}" class="responsive-img" width="200" height="100">
                    @else
                         <img src="{{url('public/img/interrogacion.png')}}" class="responsive-img" width="200" height="100">
                    @endif

                <i class="zmdi zmdi-close NavLateral-title-btn ShowHideMenu"></i>
            </header>
            <figure class="full-width NavLateral-logo">
                @if(!empty(Auth::user()->usu_ruta_foto))
                    <img src="{{url(Auth::user()->usu_ruta_foto)}}" alt="material-logo" class="responsive-img center-box materialboxed">
                @else
                    <img src="{{url('public/img/interrogacion.png')}}" alt="material-logo" class="responsive-img center-box materialboxed">
                @endif
                <figcaption class="center-align">{{Auth::user()->usu_nombre}} </figcaption>
            </figure> 
            <div class="NavLateral-Nav">
                <ul class="full-width">
                    <li>
                        <a href="{{url('principal')}}" class="waves-effect waves-light"><i class="material-icons">location_on</i> Inicio</a>
                    </li>
                    <li class="NavLateralDivider"></li>
                    <li>
                        <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="material-icons">perm_identity</i></i><i class="zmdi zmdi-chevron-down NavLateral-CaretDown"></i> Usuario</a>
                        <ul class="full-width">
                            <li><a href="{{url('administrar_usuarios')}}" class="waves-effect waves-light">Administrar usuarios</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a href="{{url('permisos_usuario')}}" class="waves-effect waves-light">Permisos de usuario</a></li>
                        </ul>
                    </li>
                    <li class="NavLateralDivider"></li>
                    <li>
                        <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="material-icons">shopping_basket</i><i class="zmdi zmdi-chevron-down NavLateral-CaretDown"></i>  Producto</a>
                        <ul class="full-width">
                            <li><a href="{{url('administrar_productos')}}" class="waves-effect waves-light">Administrar productos</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a href="{{url('administrar_unidades')}}" class="waves-effect waves-light">Unidades de medida</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a href="{{url('administrar_categorias')}}" class="waves-effect waves-light">Categorias</a></li>
                            <li class="NavLateralDivider"></li>
                        </ul>
                    </li>
                    <li class="NavLateralDivider"></li>
                   <li>
                        <a href="#" class="NavLateral-DropDown  waves-effect waves-light"><i class="material-icons">settings</i><i class="zmdi zmdi-chevron-down NavLateral-CaretDown"></i>  Configuración</a>
                        <ul class="full-width">
                            <li><a href="{{url('empresa')}}" class="waves-effect waves-light" >Información del negocio</a></li>
                            <li class="NavLateralDivider"></li>
                            <li><a href="form.html" class="waves-effect waves-light">Crear backup</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('registros_eliminados')}}" class=" waves-effect waves-light"><i class="material-icons">delete</i> Eliminado</a>
                    </li>
                </ul>
            </div>  
        </div>  
    </section>

    <!-- Page content -->
    <section class="ContentPage full-width">
        <!-- Nav Info -->
        <div class="ContentPage-Nav full-width">
            <ul class="full-width">
                <li class="btn-MobileMenu ShowHideMenu"><a href="#" class="tooltipped waves-effect waves-light" data-position="bottom" data-delay="50" data-tooltip="Menu"><i class="zmdi zmdi-more-vert"></i></a></li>
                <li><figure><img src="public/plantilla/assets/img/user.png" alt="UserImage"></figure></li>
                <li style="padding:0 5px;">{{Auth::user()->name}}</li>
                <li><a href="{{url('cerrar_sesion')}}" data-tooltip="Cerrar sesión" class="tooltipped waves-effect waves-light"><i class="zmdi zmdi-power"></i></a></li>
                <li>
                    <a href="#" class="tooltipped waves-effect waves-light btn-Notification" data-position="bottom" data-delay="50" data-tooltip="Notifications">
                        <i class="zmdi zmdi-notifications"></i>
                        <span class="ContentPage-Nav-indicator bg-danger">2</span>
                    </a>
                </li>
            </ul>   
        </div>

        <!-- Notifications area -->
        <section class="z-depth-3 NotificationArea">
            <div class="full-width center-align NotificationArea-title">Notificaciones <i class="zmdi zmdi-close btn-Notification"></i></div>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-accounts-alt bg-info"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>New User Registration</strong> 
                        <br>
                        <small>Just Now</small>
                    </p>
                </div>
            </a>  
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-cloud-download bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Updates</strong> 
                        <br>
                        <small>30 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-upload bg-success"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as UnRead"></i>
                        <strong>Archive uploaded</strong> 
                        <br>
                        <small>31 Mins Ago</small>
                    </p>
                </div>
            </a> 
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-mail-send bg-danger"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>New Mail</strong> 
                        <br>
                        <small>37 Mins Ago</small>
                    </p>
                </div>
            </a>
            <a href="#" class="waves-effect Notification">
                <div class="Notification-icon"><i class="zmdi zmdi-folder bg-primary"></i></div>
                <div class="Notification-text">
                    <p>
                        <i class="zmdi zmdi-circle-o tooltipped" data-position="left" data-delay="50" data-tooltip="Notification as Read"></i>
                        <strong>Folder delete</strong> 
                        <br>
                        <small>1 hours Ago</small>
                    </p>
                </div>
            </a>  
        </section>

        <div class="row">

            <article class="col s12">
                <h4>
                    @section('titulo')
                    @show
                </h4>
                @yield('contenido')
  
            </article>
        </div>

        <!-- Footer -->   
        <footer class="footer-MaterialDark">
            <div class="container">
                @if(count(Session::get('empresa'))>0)
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Información del negocio</h5>
                        <p class="grey-text text-lighten-4">
                            <strong>Nombre o razón social: </strong>
                            {{Session::get('empresa')->emp_nombre}}
                        </p>
                        <p class="grey-text text-lighten-4">
                            <strong>Nit: </strong>
                            {{Session::get('empresa')->emp_nit}}
                        </p>
                        <p class="grey-text text-lighten-4">
                            <strong>Correo: </strong>
                            {{Session::get('empresa')->emp_email}}
                        </p>
                        <p class="grey-text text-lighten-4">
                            <strong>Telefonos: </strong>
                            {{Session::get('empresa')->emp_telefono}}
                        </p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <br>
                        <p class="grey-text text-lighten-4">
                            <strong>Nombre del propietario: </strong>
                            {{Session::get('empresa')->emp_nombre_nombre_propietario}}
                        </p>
                        <p class="grey-text text-lighten-4">
                            <strong>Información adicional: </strong>
                            {{Session::get('empresa')->emp_descripcion}}
                        </p>
                    </div>
                </div>
                @endif
            </div>
            <div class="NavLateralDivider"></div>
            <div class="footer-copyright">
                <div class="container center-align">
                    © 2017 BOLTREX
                </div>
            </div>
        </footer>
    </section>
    
  <!-- Sweet Alert JS -->
  <script src="js/sweetalert.min.js"></script>
    
<!--   <script>window.jQuery || document.write('<script src="public/plantilla/js/jquery-2.2.0.min.js"><\/script>')</script> -->
    
    <!-- Materialize JS -->
    {!!Html::script('public/plantilla/js/materialize.min.js')!!}

    {!!Html::script('public/js/funciones.js')!!}

    <!-- Malihu jQuery custom content scroller JS -->
    {!!Html::script('public/plantilla/js/jquery.mCustomScrollbar.concat.min.js')!!}

    <!-- MaterialDark JS -->
    {!!Html::script('public/plantilla/js/main.js')!!}

</body>
</html>