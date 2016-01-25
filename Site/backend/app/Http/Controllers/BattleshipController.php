<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BattleshipController extends Controller {
    
    public function getIndex() {
		return view('welcome');
	}
	
	public function getAuth($teamKey) {
		return $teamKey;
	}
	
	public function getCreateTeam($teamKey,$teamName,$teamAbb) {
		$team = new Team;
		$team->teamKey = $teamKey;
		$team->name = $teamName;
		$team->abb = $teamAbb;
		$team->save();
	}
    
}
