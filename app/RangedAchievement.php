<?php namespace ConorSmith\Goals;

use Illuminate\Database\Eloquent\Model;

class RangedAchievement extends Model {

	protected $table = 'ranged_achievements';

    public function getDates()
    {
        return [
            'started_at',
            'finished_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

}
