<?php

Route::get('/', function () { return view('welcome'); });
	
Route::controller('api', 'BattleshipController');
