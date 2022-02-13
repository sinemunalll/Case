@include('Layout.master')
<div class="row container">



        @foreach($fixtures as $key=>$fixture)

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$key}} Hafta </h5>
                        @foreach($fixture as $key => $value)
                        <p class="card-text">{{$value['team1']}}({{$value['team1Score']}})-({{$value['team2Score']}}){{$value['team2']}}</p>
                        @endforeach
                    </div>
                </div>
            </div>


        @endforeach

            <a href="{{route('simulations')}}" class="btn btn-primary m-3">Start Simulation</a>

</div>



