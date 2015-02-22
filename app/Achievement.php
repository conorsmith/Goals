<?php namespace ConorSmith\Goals;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model {

	protected $table = 'achievements';

    public function getDates()
    {
        return [
            'achieved_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

}
