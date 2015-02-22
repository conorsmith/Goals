<?php namespace ConorSmith\Goals\Http\Controllers\Log;

use Cache;
use ConorSmith\Goals\Events\ActivityWasLogged;
use ConorSmith\Goals\Http\Requests;
use ConorSmith\Goals\Http\Controllers\Controller;
use ConorSmith\Goals\Services\GoogleDrive;
use Event;

class LogAlbumsController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        //Cache::forget('google.access_token');
		return view('log.albums');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Event::fire(new ActivityWasLogged('listen'));

        return redirect()->route('dashboard')
            ->with('message', "Updated albums from Google Sheets.");
	}

}
