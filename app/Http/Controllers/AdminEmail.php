<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Mail;

class AdminEmail extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// this script runs daily at the end of day 11:59 PM or 12:00 AM begining of the day
		

		
		//we need to find out what event is today (CURR_DATE)
		$events_data = DB::table('events')->whereDate('eventdate', '=', date('Y-m-d'))->get();

		//if we have received any events_data
		if($events_data)
		{
			foreach($events_data as $prow)
			{
				$eid = $prow->id;

				//select the visitors details, eventbookings and company details
				$myQuery = 'Select * from eventbookings e 
					inner join compdetails c
					on e.compid = c.id
					inner join compvisitors cv
					on e.stallid  = cv.stallid
    				where ((e.compid > 0 ) and (cv.eventid = ' . $eid .'))
    				group by cv.id order by e.eventid, e.stallid';
    
				$booking_data = DB::select($myQuery);
				//print_r($booking_data);

				//loop variables, initial values
				$comp_id = 0;
				$comp_email = "";
				$email_data = "";
				$nCtr = 0;


				//loop through each row
				foreach($booking_data as $row)	
				{
					//is this not the first time
					if($nCtr != 0)
					{

						//change in company id
						if($comp_id != $row->compid)
						{
							//shoot email
							Mail::send('eventmail', ['email_data' => $email_data], function ($m) use ($comp_mail){
	            				$m->from('no-reply@laravel.com', 'Event 
	            						Bookings');
	            				$m->to($comp_mail, $comp_mail)->subject('Events Visitors');
							});

							//reset variables, reinitialize them
							$email_data = "";
							$comp_mail = "";
						}
						else
						{

						}
					}


					//prepare email body
					$email_data .= "<tr>";	
					$email_data .= "<td>" . $row->uname . "</td>";	
					$email_data .= "<td>" . $row->uemail . "</td>";	
					$email_data .= "<td>" . $row->umobile . "</td>";	
					
					//debug
					//$email_data .= "<td>" . $row->stallid . "</td>";
					//$email_data .= "<td>" . $row->compid . "</td>";
					//$email_data .= "<td>" . $row->eventid . "</td>";
					$email_data .= "</tr>";	
				
					$comp_id = $row->compid;
					$comp_mail = $row->compemail;
					$nCtr++;



				}

				//notify the user
				echo("<h1>Event Mail Sent to Admin</h1>");
			}	
		}
		else{
			// no events helding today
			echo("<h1>No Events Today</h1>");
		}
	}	

	//return view('welcome')->with('events',$events);


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
