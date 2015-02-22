<?php namespace ConorSmith\Goals\Events;

use ConorSmith\Goals\Events\Event;

use Illuminate\Queue\SerializesModels;

class AchievementWasLogged extends ActivityWasLogged {

	use SerializesModels;

    private $labelToGoalMap = [
        'recipe-learned' => 'cook',
        'book-read' => 'read',
    ];

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($label)
	{
		if (!array_key_exists($label, $this->labelToGoalMap)) {
            throw new \DomainException;
        }

        $this->goalSlug = $this->labelToGoalMap[$label];
	}

}
