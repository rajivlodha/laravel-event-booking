<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$error_message = "";
		$events = "";

		try{
			$events = DB::table('events')->where('eventdate','>',Date('Y-m-d'))->get();	
		}
		catch(\Exception $e)
		{
			$error_message = "Cannot connect to database, please set proper credentials and make sure tables exists in the database";
			return view('error')->with('error_message',$error_message);
		}
		
		return view('welcome')->with('events',$events);		
		
	}

}
