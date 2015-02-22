<?php namespace ConorSmith\Goals\Events;

use ConorSmith\Goals\Events\Event;

use Illuminate\Queue\SerializesModels;

class ActivityWasLogged extends Event implements GoalEvent {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($goalSlug)
	{
		$this->goalSlug = $goalSlug;
	}

    public function getGoalSlug()
    {
        return $this->goalSlug;
    }

}
