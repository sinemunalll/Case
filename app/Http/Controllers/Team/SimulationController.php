<?php


namespace App\Http\Controllers\Team;


use App\Http\Controllers\Controller;
use App\Http\Requests\Team\IndexRequest;
use App\Services\Team\TeamService;

class SimulationController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param TeamService $teamService
     */
    public function __invoke(TeamService $teamService)
    {

        $simulate = $teamService->simulation();


        return view('Team.simulate', ['team' => $simulate['team'],'fixture'=>$simulate['fixture']]);


    }
}

