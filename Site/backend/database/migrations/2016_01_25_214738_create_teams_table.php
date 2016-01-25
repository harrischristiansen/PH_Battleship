<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration {
	public function up() {
		Schema::create('teams', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('team_key')->unsigned()->index();
			$table->string('name');
			$table->string('abb');
			$table->integer('games')->default(0);
			$table->integer('wins')->default(0);
			$table->timestamps();
		});
	}
	
	public function down() {
		Schema::drop('teams');
	}
}
