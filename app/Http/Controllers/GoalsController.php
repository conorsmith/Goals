<?php namespace ConorSmith\Goals\Http\Controllers;

use ConorSmith\Goals\Events\TargetWasUpdated;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Goal;
use Event;
use Illuminate\Http\Request;

class GoalsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('goals', [
            'goals' => Goal::all(),
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\GoalsUpdateRequest $request, $id)
	{
		foreach ($request->all() as $slug => $value) {
            $goal = Goal::where('slug', $slug)->first();

            if (!is_null($goal)) {
                $goal->value = $value;
                $goal->save();

                Event::fire(new TargetWasUpdated($goal));
            }
        }

        return redirect()->route('dashboard')
            ->with('message', "The goals were updated successfully");
	}

}
