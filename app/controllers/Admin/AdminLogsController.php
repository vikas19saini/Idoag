<?php

class AdminLogsController extends \BaseController {

	// method to list all the states data
	public function index()
	{
	    $logs = Logs::orderBy('id', 'DESC')->limit(3000)->get();//Logs::all();

	    return View::make('admin.logs')->withLogs($logs);
	}

}
