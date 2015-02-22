<?php namespace ConorSmith\Goals\Events;

use ConorSmith\Goals\Events\Event;
use ConorSmith\Goals\Goal;

use Illuminate\Queue\SerializesModels;

class TargetWasUpdated extends Event implements GoalEvent {

	use SerializesModels;

    private $goal;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Goal $goal)
	{
		$this->goalSlug = $goal->slug;
	}

    public function getGoalSlug()
    {
        return $this->goalSlug;
    }

}
