<?php namespace ConorSmith\Goals\Handlers\Events;

use ConorSmith\Goals\Events\GoalEvent;
use ConorSmith\Goals\Goal;
use ConorSmith\Goals\Model\PercentageCalculationService;
use ConorSmith\Goals\Model\ProgressCalculationService;
use ConorSmith\Goals\Progress;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RecalculateProgress {

    /**
     * @var ProgressCalculationService $progressCalculationService
     */
    private $progressCalculationService;

    /**
     * @var PercentageCalculationService $percentageCalculationService
     */
    private $percentageCalculationService;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(ProgressCalculationService $service, PercentageCalculationService $percentageCalculationService)
	{
		$this->progressCalculationService = $service;
        $this->percentageCalculationService = $percentageCalculationService;
	}

	/**
	 * Handle the event.
	 *
	 * @param  GoalEvent  $event
	 * @return void
	 */
	public function handle(GoalEvent $event)
	{
        $goal = Goal::where('slug', $event->getGoalSlug())->first();

        $this->progressCalculationService->setGoal($goal->slug);
        $this->percentageCalculationService->setGoal($goal);

        $annualTotal = $this->progressCalculationService->getAnnualTotal();
        $monthlyTotals = $this->progressCalculationService->getMonthlyTotals();

        $annualPercentage = $this->percentageCalculationService->getAnnualPercentage($annualTotal);

        Progress::where('month', null)
            ->where('goal', $goal->slug)
            ->update([
                'value' => $annualTotal,
                'percentage' => $annualPercentage,
            ]);

        foreach ($monthlyTotals as $monthIndex => $value) {
            $percentage = $this->percentageCalculationService->getMonthlyPercentage($monthIndex, $value);

            Progress::where('month', $monthIndex)
                ->where('goal', $goal->slug)
                ->update([
                    'value' => $value,
                    'percentage' => $percentage,
                ]);
        }
	}

}
