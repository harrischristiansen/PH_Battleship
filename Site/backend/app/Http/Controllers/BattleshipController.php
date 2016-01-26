<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;

use App\Models\Team;

class BattleshipController extends Controller {
    
    public function getIndex() {
		return view('pages.home');
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

	public function getLogout(Request $request) {
		$request->session()->put('loggedIn', 'false');

		return $this->getIndex();
	}
	
	// Create Team
	public function postCreateTeam(LoggedInRequest $request) {
		$team = new Team;
		$team->team_key = $request->input('teamKey');
		$team->name = $request->input('teamName');
		$team->abb = $request->input('teamAbb');
		$team->save();
		$request->session()->flash('msg', 'Team '.$team->name.' created!');
		return $this->getEditTeam($request);
	}

	public function getCreateTeam(LoggedInRequest $request) {
		return view('pages.create-team');
	}
	
	// Edit Team
	public function postEditTeam(LoggedInRequest $request, $teamID) {
		// $teamKey = $request->input('teamKey');
		$team = Team::findOrFail($teamID);
		$team->name = $request->input('teamName');
		$team->abb = $request->input('teamAbb');
		if($request->input('delete')=="delete")
		{
			$team->delete();
			$request->session()->flash('msg', 'Team '.$team->name.' deleted!');
		}
		else if($request->input('reset')=="reset")
			{
				$team->games=0;
				$team->wins=0;
				$request->session()->flash('msg', 'Team '.$team->name.' reset!');
				$team->save();
			}
		else
		{
			$request->session()->flash('msg', 'Team '.$team->name.' updated!');
			$team->save();
		}
			

		
		return $this->getEditTeam($request);
	}
	public function getEditTeam(LoggedInRequest $request,$id=0) {
		if($id==0)
		{
			$teams = Team::all();
			return view('pages.teams',compact('teams'));
		}
		$team = Team::find($id);
		return view('pages.team-detail',compact('team'));
	}



    
}
