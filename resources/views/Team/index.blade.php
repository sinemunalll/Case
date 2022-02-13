@include('Layout.master')
<div class="row justify-content-center">
    <div class="col-md-6">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Team Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <td>{{$team->name}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

        <a href="{{route('fixture')}}" class="btn btn-primary">Generate Fixture</a>

    </div>

</div>

