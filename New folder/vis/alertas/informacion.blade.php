@if(Session::has('informacion'))
    <div class="row">
    <div class="col s8 #90caf9 blue lighten-3 card-panel" style="color:white">
        <strong><i class="tiny material-icons">info_outline</i> ATENCIÓN! </strong>
        <br>
        <p>{{Session::get('informacion')}}</p>
    </div>
    </div>
@endif