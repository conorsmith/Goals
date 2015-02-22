<?php namespace ConorSmith\Goals;

use Illuminate\Database\Eloquent\Model;

class Words extends Model {

	protected $table = 'words';

    public function getDates()
    {
        return [
            'written_at',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

}
