<?php namespace ConorSmith\Goals\Http\Controllers;

use ConorSmith\Goals\Model\Goal;
use ConorSmith\Goals\Model\GoalProgress;
use ConorSmith\Goals\Goal as EloquentGoal;
use ConorSmith\Goals\Progress;

class WelcomeController extends Controller {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $models = EloquentGoal::all();
        $goals = [];

        foreach ($models as $goal) {
            $goals[] = new Goal(
                $goal->name,
                $goal->value,
                $goal->unit,
                GoalProgress::createFromEloquentCollection(Progress::where('goal', $goal->slug)->get())
            );
        }

		return view('welcome', [
            'goals' => $goals,
        ]);
	}

}
