<?php

namespace App\Http\Controllers;

use App\Models\Highscore;
use Illuminate\Http\Request;

class HighscoreController extends Controller
{
    public function addHighscore(Request $request)
    {
        $request->validate([
            'score' => 'integer|min:1|max:500',
            'player' => 'string|min:1|max:10',
            'game' => 'string|min:1|max:20'
        ]);

        $highscore = new Highscore();

        $highscore->score = $request->score;
        $highscore->player = $request->player;
        $highscore->game = $request->game;

        if ($highscore->save()) {
            return response()->json([
                'message' => 'Highscore added',
                'success' => true,
            ], 201);
        }

        return response()->json([
            'message' => 'Something went wrong',
            'success' => false
        ], 500);
    }
    public function getAllHighscores(Request $request)
    {
        $highscoresQuery = Highscore::query();

        if ($request->game) {
            $highscoresQuery = $highscoresQuery->where('game', 'LIKE', $request->game);

        }

        if ($request->player) {
            $highscoresQuery = $highscoresQuery->where('player', 'LIKE', "%$request->player%");
        }

        $highscores = $highscoresQuery->orderBy('score', 'desc')
            ->get()
            ->makeHidden(['updated_at']);

        return response()->json([
            'message' => 'Highscores retrieved',
            'success' => true,
            'data' => $highscores
        ]);
    }
}
