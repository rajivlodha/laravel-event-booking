<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

/*
Route::get('bookingdetail/{id}', function($id = 0)
{
  $data = DB::table('eventbookings')->leftJoin('compdetails', 'eventbookings.compid', '=', 'compdetails.id')->where('eventid',$id)->where('compid','>','0')->orderBy('stallid')->get();
  return json_encode($data);
});
*/


Route::get('events', 'WelcomeController@index');

//define named route
Route::get('events/{eventid}', [
    'as' => 'events', 'uses' => 'EventsController@show'
]);


Route::get('book', 'EventBookingsController@index');

Route::get('book/{eventid}/{stallid}', 'EventBookingsController@index');

Route::post('save', 'EventBookingsController@store');

Route::post('savevisitor', 'HomeController@store');

//if someone tries to access save directly

Route::get('save', function()
{
	return Response::view('error',['error_message' => 'You are not allowed to access this url directly']);
});


//this url should be called via cron job on a daily basis
Route::get('admail', 'AdminEmail@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
