<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use ConorSmith\Goals\Achievement;
use ConorSmith\Goals\Events\AchievementWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use Event;

class LogAchievementController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($label)
	{
		return view('log.achievement', [
            'label' => $label,
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Log\AchievementRequest $request, $label)
	{
        $achievement = new Achievement;

        $achievement->achieved_at = $request->date;
        $achievement->label = $label;
        $achievement->name = $request->name;

        $achievement->save();

        Event::fire(new AchievementWasLogged($label));

        return redirect()->route('dashboard')
            ->with('message', "Logged " . str_replace('-', ' ', $label) . " named '" . $request->name . "' for " . $request->date . ".");
	}

}
