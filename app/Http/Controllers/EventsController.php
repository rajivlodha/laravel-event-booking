<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$error_message = "";

		try{
			$events = DB::table('events')->where('eventdate','>',Date('Y-m-d'))->get();
		}
		catch(\Exception $e)
		{
			$error_message = "Cannot connect to database, please set proper credentials and make sure tables exists in the database";
		}
		
		if($events)
		{
			return view('welcome')->with('events',$events);
		}	
		else
		{
			$error_message="events table empty";
		}

		return view('error')->with('error_message',$error_message);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		//find the event id in the table
		
		$event = "";
		//
		$error_message = "";

		try{
			$event = DB::table('events')->where('eventdate','>',Date('Y-m-d'))->where('id',$id)->first();
		}
		catch(\Exception $e)
		{
			$error_message = "Cannot connect to database, please set proper credentials and make sure tables exists in the database";
			return view('error')->with('error_message',$error_message);
		}

		//if we received the event id
		if($event)
		{
			//load the stalls for the given table, the query below will join the eventbookigns
			//table and the compdetails table, so that we can see which stall is booked and by whom 

			$stalls = DB::table('eventbookings')->leftJoin('compdetails', 'eventbookings.compid', '=', 'compdetails.id')->where('eventid',$id)->orderBy('stallid')->get();

			//if we find the stalls
			if($stalls)
			{
				return view('events')->with('stalls',$stalls)->with('event',$event);
			}
			else
			{
				$error_message="Stalls table empty";
			}
		}
		else
		{
			$error_message="We are sorry this event does not exist in the database";
		}	

		return view('error')->with('error_message',$error_message);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
