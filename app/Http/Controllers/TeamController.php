<?php

namespace App\Http\Controllers;

use App\Models\Team;

// Requests
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $teams = Team::all();
            return response()->json($teams);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Unable to fetch teams',
                'message' => $th->getMessage()
            ], $th->getCode() ?: 500);
        }
    }
}
