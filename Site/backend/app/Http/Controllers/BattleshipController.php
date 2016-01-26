<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;

use App\Models\Team;

class BattleshipController extends Controller {
    
    public function getIndex() {
		return view('welcome');
	}
	
	public function getLogin() {
		return view('pages.login');
	}

	public function postLogin(Request $request) {
		$password = $request->input('password');

		if($password == env('SITE_PASS')) {
			$request->session()->put('loggedIn', 'true');
		}

		return $this->getIndex();
	}
	
	// Create Team
	public function postCreateTeam(LoggedInRequest $request) {
		$team = new Team;
		$team->team_key = $request->input('teamKey');
		$team->name = $request->input('teamName');
		$team->abb = $request->input('teamAbb');
		$team->save();
	}
	
	// Edit Team
	public function postEditTeam(LoggedInRequest $request) {
		$teamKey = $request->input('teamKey');
		$team = Team::where('team_key',$teamKey)->first();
		$team->name = $request->input('teamName');
		$team->abb = $request->input('teamAbb');
		$team->save();
	}
    
}
