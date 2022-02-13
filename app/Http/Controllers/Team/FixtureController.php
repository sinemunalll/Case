<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\IndexRequest;
use App\Services\Team\TeamService;


class FixtureController extends Controller
{

    /**a
     * Handle the incoming request.
     *
     * @param TeamService $teamService
     */
    public function __invoke(IndexRequest $request,TeamService $teamService)
    {

        $fixtures = $teamService->fixtures(
            $request->all()
        );


        return view('Team.fixture', ['fixtures' =>$fixtures]);

    }
}
