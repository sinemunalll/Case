<?php


namespace App\Services\Team;



use App\Repositories\Fixture\FixtureRepository;
use App\Repositories\Score\ScoreRepository;
use App\Repositories\Team\TeamRepository;
use App\Traits\GenericFixture;
use Illuminate\Support\Arr;

class TeamService implements TeamServiceInterface
{
   use GenericFixture;

    /**
     * @var ScoreRepository
     */
    private $scoreRepo;

    /**
     *
     * @param TeamRepository $teamRepository
     * @param FixtureRepository $fixtureRepository
     */


    public function __construct(TeamRepository $teamRepository, FixtureRepository $fixtureRepository, ScoreRepository $scoreRepository)
    {
        $this->repository = $teamRepository;
        $this->fixtureRepo = $fixtureRepository;
        $this->scoreRepo = $scoreRepository;
    }

    public function index($request)
    {
        return $this->repository->get($request);
    }


    public function fixtures($request)
    {

        $fixtures = $this->fixtureRepo->get([
            'include' => [
                'firstTeam', 'secondTeam'
            ]
        ]);

        $teams = $this->repository->get([])->pluck('id')->toArray();

        if (count($fixtures) == 0) {
           $fixtures = $this->genericFixture($teams);

        }


        return $fixtures->map(function ($value) {
            return [
                'week' => $value->week,
                'team1' => $value->firstTeam->name,
                'team2' => $value->secondTeam->name,
                'team1Score' =>$value->team1Score,
                'team2Score' =>$value->team2Score,
            ];
        })->sortBy('week')->groupBy('week');



    }

    public function simulation()
    {

        $team = $this->repository->get([]);
        $fixtures = $this->fixtureRepo->get([
            'filter' => [
                'week' => 1
            ],
            'include' => [
                'firstTeam', 'secondTeam'
            ]
        ]);
        $fixtures = $fixtures->map(function ($value) {
            return [
                'week' => $value->week,
                'team1' => $value->firstTeam->name,
                'team2' => $value->secondTeam->name,
                'team1Score' => $value->team1Score,
                'team2Score' => $value->team2Score,
            ];
        })->sortBy('week')->groupBy('week');


        return ['team' => $team, 'fixture' => $fixtures];
    }

    public function fixtureAll($week)
    {
        $fixtures = $this->fixtureRepo->get([
            'filter' => [
                'week' => $week
            ],
            'include' => [
                'firstTeam', 'secondTeam'
            ]
        ]);
        $fixtures = $fixtures->map(function ($value) {
            return [
                'week' => $value->week,
                'team1' => $value->firstTeam->name,
                'team2' => $value->secondTeam->name,
                'team1Score' => $value->team1Score,
                'team2Score' => $value->team2Score,
            ];
        })->sortBy('week')->groupBy('week');


        return $fixtures;

    }

    public function playAllWeek()
    {


        $fixtures = $this->fixtureRepo->get([])->toArray();

        $this->scoreRepo->delete([]);


            foreach ($fixtures as $fixture) {


                if($fixture['team1Score'] > $fixture['team2Score']) {
                    $dataTeam1 = [
                        'team'=>$fixture['team1'],'win' => 1, 'point' => 3, 'lose' => 0, 'draw' => 0,'gol_diff'=>$fixture['team1Score']-$fixture['team2Score']
                    ];
                    $dataTeam2 = [
                        'team'=>$fixture['team2'],'win' => 0, 'point' => 0, 'lose' => 1, 'draw' => 0,'gol_diff'=>$fixture['team2Score']-$fixture['team1Score']
                    ];

                }
                else if ($fixture['team1Score'] < $fixture['team2Score']){
                    $dataTeam1 = [
                        'team'=>$fixture['team1'],'win' => 0, 'point' => 0, 'lose' => 1, 'draw' => 0,'gol_diff'=>1
                    ];
                    $dataTeam2 = [
                        'team'=>$fixture['team2'],'win' => 1, 'point' => 3, 'lose' => 0, 'draw' => 0,'gol_diff'=>1
                    ];
                } else{
                    $dataTeam1 = [
                        'team'=>$fixture['team1'],'win' => 0, 'point' => 1, 'lose' => 0, 'draw' => 1,'gol_diff'=>$fixture['team1Score']-$fixture['team2Score']
                    ];
                    $dataTeam2 = [
                        'team'=>$fixture['team2'],'win' => 0, 'point' => 1, 'lose' => 0, 'draw' => 1,'gol_diff'=>$fixture['team2Score']-$fixture['team1Score']
                    ];
                }


                $this->scoreRepo->create($dataTeam1);
                $this->scoreRepo->create($dataTeam2);




            }



        $teams=$this->repository->get([]);
        $data=collect();

        foreach ($teams as $team){
            $data->add([
                'team'=>$team->id,
                'teamName'=>$team->name,
                'point' =>$this->scoreRepo->pointTotal($team->id),
                'win' =>$this->scoreRepo->pointWin($team->id),
                'lose' =>$this->scoreRepo->pointLose($team->id),
                'draw' => $this->scoreRepo->pointDraw($team->id),
                'gol_diff' => $this->scoreRepo->golDiff($team->id),
            ]);
        }


        return $data;



    }

    public function check($team1, $team2)
    {
        if ($team1 > $team2) {
            return 'win';
        } else if ($team1 < $team2) {
            return 'lose';
        } else
            return 'draw';
    }





//    public function generateFixture(){
//        $teamsArray=$this->repository->get([])->pluck('id')->toArray();
//        $const=Arr::random($teamsArray);
//
//
//        unset($teamsArray[array_search($const,$teamsArray)]);
//
//
//        $newArray = [];
//
//
//        foreach ($teamsArray as $team){
//            array_push($newArray,$team);
//        }
//
//
//        $n=count($newArray);
//
//         for ($i=0; $i<=$n-1; $i++){
//             $data = [
//                 'week'=>$i+1,
//                 'team1' => $const,
//                 'team2'=> $newArray[0]
//             ];
//
//
//             $this->fixtureRepo->create($data);
//
//
//           for($j=1;$j<=($n-1)/2;$j++){
//
//               $dat = [
//                   'week'=>$i+1,
//                   'match' =>$j+1 . 'Maç',
//                   'team1' => $newArray[$j],
//                   'team2'=> $newArray[$n-$j]
//               ];
//               $this->fixtureRepo->create($dat);
//          }
//           $data=array_pop($newArray);
//
//           array_unshift($newArray,$data);
//
//         }
//
//    }
}
