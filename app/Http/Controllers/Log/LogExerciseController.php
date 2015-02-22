<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use Carbon\Carbon;
use ConorSmith\Goals\Events\ActivityWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Workout;
use Event;

class LogExerciseController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($sport)
	{
		return view('log.exercise', [
            'sport' => $sport,
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Log\ExerciseRequest $request, $sport)
	{
        $file = $request->file('workout_file');

        if ($file->getClientOriginalExtension() !== 'tcx') {
            throw new \DomainException("The data must be in a .tcx workout file.");
        }

        $workoutData = new \SimpleXMLElement(file_get_contents($file->getRealPath()));

        $this->checkSport($workoutData, $sport);

        $lap = $workoutData->Activities->Activity->Lap;

        $workout = new Workout;

        $workout->exercised_at = new Carbon($lap['StartTime']);
        $workout->sport = $sport;
        $workout->distance = $lap->DistanceMeters / 1000;

        $workout->save();

        Event::fire(new ActivityWasLogged($this->mapSportToGoalSlug($sport)));

        return redirect()->route('dashboard')
            ->with('message', "Logged $sport workout of " . $workout->distance . "km for " . $workout->exercised_at->format('Y-m-d') . ".");
	}

    private function checkSport($workoutData, $sport)
    {
        $map = [
            'Running' => 'running',
            'Other' => 'walking',
        ];

        if ($map[(string) $workoutData->Activities->Activity['Sport']] !== $sport) {
            throw new \DomainException("The workout file is for type " . $workoutData->Activities->Activity['Sport'] . ", but it should be $sport.");
        }
    }

    private function mapSportToGoalSlug($sport)
    {
        $map = [
            'running' => 'run',
            'walking' => 'walk',
        ];

        return $map[$sport];
    }

}
