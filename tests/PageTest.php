<?php

use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

Class PageTest Extends IntegrationTest{

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	protected $baseUrl = "http://localhost";
	public function testHomePageSeeText()
	{
		//Get the home page
		$this->visit('/')->see('Welcome to Gala Events');
	}

	public function testEventsPageSeeText()
	{
		//get the events page, same as home page
		$this->visit('/events/')->see('Welcome to Gala Events');	
	}

	public function testParicularEventPageSeeText()
	{
		//check event page for event number 5
		$this->visit('/events/5/')->see('CentOS Event');	
	}

	public function testParicularExpiredEventPageSeeText()
	{
		//check event page for event number 1 which is expired
		$this->visit('/events/5/')->see('Oops, Error');	
	}

	public function testParicularEventWhicDoesNotExistsSeeText()
	{
		//check event page for event number 50
		$this->visit('/events/50/')->see('Oops, Error');	
	}


	public function testParicularBookingPageSeeText()
	{
		// see the booking page for event 5 and stall 2
		// may return an error if stall number 2 of event 5 is 
		// already booked or the event gets expired
		// to run this test find a stall id which is not
		// booked, otherwise the test would fail as 
		// we do not allow people to book stall which
		// is already booked
		
		/* 
		$this->visit('/book/5/2')->see('Book Stall');	
		*/

	}


	public function testParicularBookingWhereStallDoesNotExistsSeeText()
	{
		//see the booking page for event number 5 and stall number 20 
		//stall 20 does not exists
		$this->visit('/book/5/20')->see('Oops, Error');	
	}

	public function testParicularBookingWhereStallAlreadyBookedSeeText()
	{
		//visit the booking page for a stall which is already booked
		//will result into error which we trap
		$this->visit('/book/5/1')->see('Oops, Error');	
	}

}