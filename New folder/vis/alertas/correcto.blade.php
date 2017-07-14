@if(Session::has('correcto'))
    <div class="row">
    <div class="col s8 #81c784 green lighten-2 card-panel" style="color:white">
        <strong><i class="tiny material-icons">done_all</i> CORRECTO! </strong>
        <br>
        <p>{{Session::get('correcto')}}</p>
    </div>
    </div>
@endif