<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\IndexRequest;
use App\Services\Team\TeamService;


class IndexController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param IndexRequest $request
     * @param TeamService $teamService
     */
    public function __invoke(IndexRequest $request, TeamService $teamService)
    {

        $teams = $teamService->index(
            $request->all()
        );


        return view('Team.index', ['teams' => $teams]);

    }
}
