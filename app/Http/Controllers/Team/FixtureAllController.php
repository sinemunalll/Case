<?php


namespace App\Http\Controllers\Team;


use App\Http\Controllers\Controller;
use App\Services\Team\TeamService;

class FixtureAllController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param TeamService $teamService
     */
    public function __invoke(TeamService $teamService,int $week)
    {

        $fixtureAll = $teamService->fixtureAll($week);


        return response()->json($fixtureAll);


    }
}
