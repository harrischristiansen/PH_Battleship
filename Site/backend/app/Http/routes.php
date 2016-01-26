<?php

Route::group(['middleware' => ['web']], function () {
	Route::controller('api', 'APIController');
    Route::controller('/', 'BattleshipController');
});