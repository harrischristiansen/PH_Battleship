<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('winner')->unsigned();
            $table->foreign('winner')->references('team_key')->on('teams');
            $table->integer('loser')->unsigned();
            $table->foreign('loser')->references('team_key')->on('teams');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('games');
    }
}
