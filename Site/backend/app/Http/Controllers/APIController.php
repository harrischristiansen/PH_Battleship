<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;

use App\Models\Team;
use App\Models\Game;
class APIController extends Controller {
    
    public function getIndex() {
		return view('pages.home');
	}
	
	public function getAuth($teamKey) {
		$team = Team::where('team_key',$teamKey)->first();
		if($team != null) {
			return "true";
		}
		return "false";
	}
	public function getGame($winner,$loser)
	{
		$game = new Game;
		$game->winner=$winner;
		$game->loser=$loser;
		$game->save();

		$winner = Team::where("team_key",$winner)->first();
		$winner->wins++;
		$winner->games++;
		$winner->save();

		$loser = Team::where("team_key",$loser)->first();
		$loser->games++;
		$loser->save();

		return "ok";
	}
    
}
