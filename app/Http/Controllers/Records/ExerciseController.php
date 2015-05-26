<?php namespace ConorSmith\Goals\Http\Controllers\Records;

use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Workout;

class ExerciseController extends Controller {

    public function index($sport)
    {
        $workouts = Workout::where('sport', $sport)
            ->orderBy('exercised_at', 'desc')
            ->get();

        return view('records.exercise', [
            'sport' => $sport,
            'workouts' => $workouts,
            'timezone' => new \DateTimeZone('Europe/Dublin'),
        ]);
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
