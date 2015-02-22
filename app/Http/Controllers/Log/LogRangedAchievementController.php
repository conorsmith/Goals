<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use ConorSmith\Goals\Events\AchievementWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\RangedAchievement;
use Event;
use Illuminate\Http\Request;

class LogRangedAchievementController extends Controller {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($label)
	{
		return view('log.rangedachievement', [
            'label' => $label,
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Log\RangedAchievementRequest $request, $label)
	{
        $rangedAchievement = new RangedAchievement;

        $rangedAchievement->started_at = $request->from_date;
        $rangedAchievement->finished_at = $request->to_date;
        $rangedAchievement->label = $label;
        $rangedAchievement->name = $request->name;

        $rangedAchievement->save();

        Event::fire(new AchievementWasLogged($label));

        return redirect()->route('dashboard')
            ->with('message', "Logged " . str_replace('-', ' ', $label) . " named '" . $request->name . "' for " . $request->to_date . ".");
	}

}
