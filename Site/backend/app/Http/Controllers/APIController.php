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
			return $team->abb;
		}
		return "False";
	}
	
	public function getGame($winner,$loser) {
		$winner = Team::where("abb",$winner)->first();
		if($winner != null) {
			$winner->wins++;
			$winner->games++;
			$winner->save();
			$winnerKey = $winner->team_key;
		}

		$loser = Team::where("abb",$loser)->first();
		if($loser != null) {
			$loser->games++;
			$loser->save();
			$loserKey = $loser->team_key;
		}
		
		if($winner!=null && $loser!=null) {
			$game = new Game;
			$game->winner=$winnerKey;
			$game->loser=$loserKey;
			$game->save();
		}

		return "Ok";
	}
	
	public function getReset() {
		$teams = Team::all();
		foreach($teams as $team) {
			$team->games=0;
			$team->wins=0;
			$team->save();
		}
		
		return "Ok";
	}
    
}
