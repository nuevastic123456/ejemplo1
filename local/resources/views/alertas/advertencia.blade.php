@if(Session::has('advertencia'))
    <div class="row">
    <div class="col s8 #ffb74d orange lighten-2 card-panel" style="color:white">
        <strong><i class="tiny material-icons">info</i> CUIDADO! </strong>
        <br>
        <p>{{Session::get('advertencia')}}</p>
    </div>
    </div>
@endif