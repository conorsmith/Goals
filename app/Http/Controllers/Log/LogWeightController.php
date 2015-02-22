<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use ConorSmith\Goals\Events\ActivityWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Weight;
use Event;
use Illuminate\Http\Request;

class LogWeightController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('log.weight');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Log\WeightRequest $request)
	{
        $weight = new Weight;

        $weight->measured_at = $request->date;
        $weight->measurement = $request->measurement;

        $weight->save();

        Event::fire(new ActivityWasLogged('weigh'));

        return redirect()->route('dashboard')
            ->with('message', "Logged weight of " . $request->measurement . " for " . $request->date . ".");
	}

}
