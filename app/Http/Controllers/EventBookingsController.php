<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\eventbookings;
use App\Events;
use App\compdetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;	
use Illuminate\Support\Facades\Input;

class EventBookingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($eventid = 0, $stallid = 0)
	{
		// search for the event id passed as query string
		$event = DB::table('events')->where('eventdate','>',Date('Y-m-d'))->where('id',$eventid)->first();
		$error_message = "";

		//if event exists
		if($event)
		{
			//redirect the user to the booking page with the given event id and stall number
			$stall = DB::table('eventbookings')->where('eventid',$eventid)->where('stallid',$stallid)->first();

			//check if we have the given stall before booking, and thats available for booking
			if($stall && $stall->compid == 0)
			{
				return view('eventbookings')->with('event',$event)->with('stallid',$stallid);
			}
			else{
				$error_message = "No such stall available here or the stall is already booked, please try again";
			}	
		}
		else
		{
			$error_message = "No such events available here, please try again";
			
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

		/*
			This function stores the user booking data and saved the same into the 
			database, a company is created in the company table and the eventbookings
			table is updated with the company id and the stall id which the company booked
		*/

		// create an object for the company 	
		$data = new compdetails;
		$compid = 0;		

		$eventID = Input::get('eventid');
		$stallID = Input::get('stallid');
		$error_message	= "";

		//check if we have the event id and stall id in our table
		if( !(DB::table('events')->where('eventdate','>',Date('Y-m-d'))->where('id',$eventID)->first()) && (DB::table('events')->where('id',$eventID)->first()) ){

			$error_message .= "<p>No such events or stall available here, please go back and try again</p>";
		 }	

		//flag which determines whether to store data in company table or not
		$saveData = false;

		//if we are not access directly
		if (Input::server("REQUEST_METHOD") == "POST")
		{
			//we need the basic details of the company
			if(Input::has('compname') && Input::has('email')  && Input::has('contact') )
			{
	    		$data->compname = Input::get('compname');
	    		$data->compemail = Input::get('email');
	    		$data->compaddr = Input::get('address');
	    		$data->compweb = Input::get('website');
	    		$data->compcontact = Input::get('contact');

	    		//we received the data
	    		$saveData = true;
	    	}
	    }

	    //check if user has sent the required logo
	    if (Input::hasFile('complogo'))
	    {
    		$logoName = str_random(6) . Input::file('complogo')->getClientOriginalName();
	 		Input::file('complogo')->move(base_path() . '/public/xdata/logos/', $logoName);
	    }
	    else
	    {
	    	$logoName = "0.png";
	    	$saveData = false;
	    	$error_message .= "<p>Please upload logo</p>";
	    }


	    //check if the user has uploaded the required marketing material
	    if (Input::hasFile('compppt'))
	    {

	    	$pptName = str_random(6) . Input::file('compppt')->getClientOriginalName();
 			Input::file('compppt')->move(base_path() . '/public/xdata/ppt/', $pptName);
 		}
 		else
 		{
 			$pptName = "sample.pdf";
 			$saveData = false;
 			$error_message .= "<p>Please upload Marketing Material (PDF/PPT)</p>";
 		}

	    //file attachments
	    $data->complogo = $logoName;
	    $data->compppt = $pptName;

	    //check our flag for everything is ok and we received all data from the user
	    if($saveData)
	    {
	    	//save company details in compdetails table
	    	if($data->save()) 
	    	{
	    	    $compid = $data->id;

	    	    // we need to update eventbookings table with the company id
	    	    // and stall id it has booked for	    	    

	    	    /*
        		eventbookings::where('eventid', '=', (int)Input::get('eventid'))
        		->where('stallid', '=', (int)Input::get('stallid'))
        		->update(array('compid' => $compid));

        		Not working as there is no primary key i guess
				*/

				DB::statement(
					'update eventbookings set compid = ' . $compid . 
					' where (eventid = ' . $eventID . 
					' and stallid = ' . $stallID . ')'  );


	    	}
	    	else
	    	{
	    		$error_message = "<p>Could not save company data</p>";
	    	}
		}
		else
		{
			$error_message .= "<p>Please fill in all fields in the form</p>";
		}

		//if we have a new company id
    	if($compid > 0)
    	{
    		//redirect user to failed
    		return redirect()->route('events' , Input::get('eventid'));
    	}
    	else{
			return view('error')->with('error_message',$error_message);	
    	}
        
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
