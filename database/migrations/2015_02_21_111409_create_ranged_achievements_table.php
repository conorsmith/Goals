<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangedAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ranged_achievements', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('started_at');
            $table->date('finished_at');
            $table->string('label');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ranged_achievements');
	}

}
