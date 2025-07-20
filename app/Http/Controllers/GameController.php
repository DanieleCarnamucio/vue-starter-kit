<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// Models
use App\Models\Team;
// Requests
use App\Http\Requests\GameRequest;

class GameController extends Controller
{
    public function play(GameRequest $request)
    {
        $team_1 = Team::find($request->team_1);
        $team_2 = Team::find($request->team_2);
        return response()->json([
            'message' => 'Game started successfully',
            'team_1' => $team_1,
            'team_2' => $team_2,
        ]);
    }
}
