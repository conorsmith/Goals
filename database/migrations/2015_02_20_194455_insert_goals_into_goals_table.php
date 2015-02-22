<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertGoalsIntoGoalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('goals')->insert([
            [
                'name' => "Run",
                'slug' => "run",
                'unit' => "km",
            ],
            [
                'name' => "Walk",
                'slug' => "walk",
                'unit' => "km",
            ],
            [
                'name' => "Weigh",
                'slug' => "weigh",
                'unit' => "kg",
            ],
            [
                'name' => "Cook",
                'slug' => "cook",
                'unit' => "recipes",
            ],
            [
                'name' => "Listen",
                'slug' => "listen",
                'unit' => "albums",
            ],
            [
                'name' => "Read",
                'slug' => "read",
                'unit' => "books",
            ],
            [
                'name' => "Write",
                'slug' => "write",
                'unit' => "words",
            ],
        ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('goals')->truncate();
	}

}
