@include('Layout.master')
<div class="row justify-content-center">
    <div class="col-md-4">

                <table class="table" id="points-table">
                    <thead>
                    <tr>
                        <th scope="col">Team Name</th>
                        <th scope="col">P</th>
                        <th scope="col">W</th>
                        <th scope="col">D</th>
                        <th scope="col">L</th>
                        <th scope="col">GD</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>



                        </tr>
                    @endforeach
                    </tbody>
                </table>

        <a  class="btn btn-primary playAllWeek">Play All Weeks</a>

    </div>
    <div class="col-md-4">

                <table class="table" id="week">
                    <thead>
                    <tr>
                        <th scope="col"><span class="weekName">1</span>. Hafta</th>
                    </tr>
                    </thead>
                    <tbody class="teams">
                    @foreach($fixture as $item)
                        @foreach($item as $key=>$value)
                            <tr>
                                <td>{{$value['team1']}}({{$value['team1Score']}})-({{$value['team2Score']}}){{$value['team2']}}</td>
                            </tr>
                        @endforeach


                    @endforeach

                    </tbody>
                </table>

        <button  class="btn btn-primary nextWeek">Play Next Week</button>

    </div>
    <div class="col-md-4">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Championship Prodictions</th>
                        <td>%</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>0</td>




                        </tr>
                    @endforeach

                    </tbody>
                </table>

        <a href="{{route('fixture')}}" class="btn btn-primary">Generate Fixture</a>

    </div>


</div>

<script type="text/javascript">

    $( document ).ready(function() {
        function getFixtureAll(step){
            $.ajax({
                url: "/fixtures/all/"+step,
                type: 'GET',
                success: function (result) {
                    if(result.length != 0){
                        $('.weekName').html(step);
                        var table='';
                        $.each(result[step],function( index, value ) {
                            table+='<tr><td>'+value.team1+'('+value.team1Score+')'+'-' +'('+value.team2Score+')'+value.team2+'</td></tr>';
                        });
                        $('.teams').html(table)
                    }

                }
            });
        }
        function playAllWeek(){
            $.ajax({
                url: "/fixtures/all/week/play/",
                type: 'GET',
                success: function (result) {

                    var row = "<row>";

                    $.each(result,function( index, value ) {
                        row += '<tr><td>'+value.teamName+'</td>';
                        row += '<td>'+value.point+'</td>';
                        row += '<td>'+value.win+'</td>';
                        row += '<td>'+value.draw+'</td>';
                        row += '<td>'+value.lose+'</td>';
                        row += '<td>'+value.gol_diff+'</td></tr>';
                    });
                    row += "</row>"
                    $('#points-table tbody').html(row)
                }
            });
        }
        var step=1;
        $('.nextWeek').on('click',function () {
            step++
            getFixtureAll(step)
        })
        $('.playAllWeek').on('click',function () {

            playAllWeek()
        })

    });

</script>

