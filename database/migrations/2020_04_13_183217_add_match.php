<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('id');
            $table->string('local_team');
            $table->string('visitor_team');
            $table->dateTime('date');
            $table->string('localisation');
            $table->integer('season_id');
            $table->string('winning_team');
            $table->string('losing_team');
            $table->integer('final_score_local');
            $table->integer('final_score_visitor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
