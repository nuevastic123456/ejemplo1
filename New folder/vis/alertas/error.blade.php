@if(Session::has('error'))
    <div class="row">
    <div class="col s8 #ef5350 red lighten-1 card-panel offset-m2" style="color:white">
        <strong><i class="tiny material-icons">report_problem</i> ERROR!</strong>
        <br>
        <p>{{Session::get('error')}}</p>
    </div>
    </div>
@endif