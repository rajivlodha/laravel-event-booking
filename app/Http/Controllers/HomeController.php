<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		try{
			
				$events = DB::table('events')->where('eventdate','>',Date('Y-m-d'))->get();
		

				return view('home')->with('events',$events);
		}
		catch(\Exception $e)
		{
			return view('error');
		}

		
	}


	public function booking()
	{
		//return view('home');
		//Do Something
	}



	public function store()
	{
		//return view('home');
		//Do Something
	}

}
