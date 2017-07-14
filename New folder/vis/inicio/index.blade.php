



<!-- 
* Copyright 2016 Carlos Eduardo Alfaro Orellana
-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Material Dark</title>
  
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

</head>
<body class="font-cover" id="login">
        
    <div class="container-login center-align">
        <div style="margin:15px 0;">
        <img src="public/img/logo.png" width="338" height="150" class=" materialboxed" > 
            <p>Inicia sesión con tu cuenta</p>   
        </div>
          @include('alertas.error')
          @include('alertas.correcto')
          @include('alertas.valida_campos')

          {!! Form::open(['route' => 'login.ingresar','method' => 'post']) !!}
            <div class="input-field">
                <input id="UserName" type="text" class="validate" name="usuario" value="{{old('usuario')}}">
                <label for="UserName"><i class="zmdi zmdi-account"></i>&nbsp; Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="Password" type="password" class="validate" name="contrasenia">
                <label for="Password"><i class="zmdi zmdi-lock"></i>&nbsp; Contraseña</label>
            </div>

            <div class="input-field  col s12">
            <input type="checkbox" id="test6" name="recordar" />
            <label for="test6">Recordar contraseña</label>
            </div>
            
            <div class="divider" style="margin: 20px 0;"></div>

            <button class="waves-effect waves-light btn">Ingresar &nbsp; <i class="zmdi zmdi-mail-send"></i></button>
        {!! Form::close() !!}
        <div class="divider" style="margin: 20px 0;"></div>
        
    </div>
    
    <!-- Sweet Alert JS -->
    {!!Html::script('public/plantilla/js/sweetalert.min.js')!!}

    <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="public/plantillajs/jquery-2.2.0.min.js"><\/script>')</script>
    
    <!-- Materialize JS -->
    {!!Html::script('public/plantilla/js/materialize.min.js')!!}

    <!-- Malihu jQuery custom content scroller JS -->
    {!!Html::script('public/plantilla/js/jquery.mCustomScrollbar.concat.min.j')!!}

    <!-- MaterialDark JS -->
    {!!Html::script('public/plantilla/js/js/main.js')!!}
</body>
</html>