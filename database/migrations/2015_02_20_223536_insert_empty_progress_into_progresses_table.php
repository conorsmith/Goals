<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertEmptyProgressIntoProgressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $goals = [
            'run',
            'walk',
            'weigh',
            'cook',
            'listen',
            'read',
            'write',
        ];

        $rows = [];

        foreach ($goals as $goal) {
            $rows[] = [
                'goal' => $goal,
                'month' => null,
                'value' => 0,
                'percentage' => 0,
            ];

            for ($i = 1; $i <= 12; $i++) {
                $rows[] = [
                    'goal' => $goal,
                    'month' => $i,
                    'value' => 0,
                    'percentage' => 0,
                ];
            }
        }

		DB::table('progresses')->insert($rows);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('progresses')->truncate();
	}

}
