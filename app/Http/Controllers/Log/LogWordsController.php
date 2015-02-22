<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use ConorSmith\Goals\Events\ActivityWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Words;
use Event;

class LogWordsController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('log.words');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\Log\WordsRequest $request)
	{
        $words = new Words;

        $words->written_at = $request->date;
        $words->word_count = $request->word_count;
        $words->title = $request->title;

        $words->save();

        Event::fire(new ActivityWasLogged('write'));

        return redirect()->route('dashboard')
            ->with('message', "Logged " . $request->word_count . " words written of '" . $request->title . "' for " . $request->date . ".");
	}

}
