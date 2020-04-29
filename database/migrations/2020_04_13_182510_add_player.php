<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->nullable();
        });

        Schema::create('player_team', function (Blueprint $table) {
            $table->integer('team_id');
            $table->integer('player_id');
            $table->primary(['team_id', 'player_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
        Schema::dropIfExists('player_team');
    }
}
