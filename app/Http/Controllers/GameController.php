<?php

namespace App\Http\Controllers;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class GameController extends Controller{
    public function store($id) {
        $game = new Game;
        $game->dice_1 = rand(1,6);
        $game->dice_2 = rand(1,6);
        $game->user_id = $id;
        $game->save();

        return response()->json(["success" => true, "message" => "Partida realitzada correctament"],200);
    }
    
}
