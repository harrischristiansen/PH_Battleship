<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LoggedInRequest;
use App\Http\Controllers\Controller;

use App\Models\Team;

class APIController extends Controller {
    
    public function getIndex() {
		return view('welcome');
	}
	
	public function getAuth($teamKey) {
		$team = Team::where('team_key',$teamKey)->first();
		if($team != null) {
			return "true";
		}
		return "false";
	}
	
	public function getAddGame($teamKey) {
		return "";
	}
	
	public function getAddWin($teamKey) {
		return "";
	}
    
}
