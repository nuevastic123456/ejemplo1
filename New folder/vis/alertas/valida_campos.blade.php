    @if (count($errors) > 0)
    <div class="row">
    <div class="col s8 #ef5350 red lighten-1 card-panel offset-m2" style="color:white">
        <strong><i class="tiny material-icons">report_problem</i> ERROR! No se han enviado los datos del formulario: </strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="tiny material-icons">trending_flat</i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    </div>
    @endif