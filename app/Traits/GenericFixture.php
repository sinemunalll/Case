<?php


namespace App\Traits;


use App\Repositories\Fixture\FixtureRepository;
use Illuminate\Support\Arr;

trait GenericFixture
{
      public function genericFixture(array $teams)
      {

          $fixtureRepo=app()->make(FixtureRepository::class);

          $const=Arr::random($teams);



          unset($teams[array_search($const,$teams)]);


          $newArray = [];


          foreach ($teams as $team){
              array_push($newArray,$team);
          }


          $n=count($newArray);


          for ($i=0; $i<=$n-1; $i++){

              $data = [
                  'week'=>$i+1,
                  'team1' => $const,
                  'team2'=> $newArray[0],
                  'team1Score'=>random_int(0, 10),
                  'team2Score'=>random_int(0, 10),
              ];



              $fixtureRepo->create($data);



              for($j=1;$j<=($n-1)/2;$j++){

                  $dat = [
                      'week'=>$i+1,
                      'match' =>$j+1 . 'Maç',
                      'team1' => $newArray[$j],
                      'team2'=> $newArray[$n-$j],
                      'team1Score'=>random_int(0, 10),
                      'team2Score'=>random_int(0, 10),
                  ];
                  $fixtureRepo->create($dat);
              }
              $data=array_pop($newArray);

              array_unshift($newArray,$data);

          }


          return $fixtureRepo->get([]);


      }
}
