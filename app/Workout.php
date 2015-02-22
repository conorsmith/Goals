<?php namespace ConorSmith\Goals;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model {

	protected $table = 'workouts';

    public function getDates()
    {
        return [
            'exercised_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

}
