<?php


namespace App\Http\Controllers\Team;


use App\Http\Controllers\Controller;

use App\Services\Team\TeamService;

class PlayAllWeekController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param TeamService $teamService
     */
    public function __invoke(TeamService $teamService)
    {

        $playAllWeek = $teamService->playAllWeek();

        return response()->json($playAllWeek);



    }
}
