<?php

use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

Class BookingTest Extends IntegrationTest{

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	protected $baseUrl = "http://localhost";
	
	public function testBookStallWhichIsNotRegistered()
	{

		/*

			This test may fail if you do not provide
			a proper event id and stall id
			please note that the event id must be a 
			future event and the stall id must not
			be registered

		*/

		//enter the event id for which you need to book the stall
		$event_id = "6";

		//enter the stall id of the above event which you need to book
		$stall_id = "4";

		//make the booking url
		$booking_url = '/book/' . $event_id . "/" . $stall_id;

		//this is where we will get redirected when the data is saved in the db
		$event_url = '/events/' . $event_id;

        $this->visit($booking_url)
        	->type('Lara Test', 'compname')
            ->type('lara@laravel.com', 'email')
            ->type('Kiran Thapar', 'contact')
            ->type('1 Red Road', 'address')
            ->type('www.laravel.com', 'website')
            ->type('/usr/share/pixmaps/fedora-logo.png', 'complogo')
            ->type('/home/rajiv/rajivprj/public/xdata/ppt/ibm.pdf', 'compppt')
            ->press('Confirm Reservation')
            ->seePageIs($event_url);

	}

public function testBookStallWhichIsRegisteredAndFails()
	{

		/*

			This test WILL fail as we are providing event id
			for an event which is expired, the user will be
			redirected to error page
		*/

		//enter the event id for which you need to book the stall
		$event_id = "1";

		//enter the stall id of the above event which you need to book
		$stall_id = "1";

		//make the booking url
		$booking_url = '/book/' . $event_id . "/" . $stall_id;

		//this is where we will get redirected when the data is saved in the db
		$event_url = '/error/';

        $this->visit($booking_url)
        	->type('Lara Test', 'compname')
            ->type('lara@laravel.com', 'email')
            ->type('Kiran Thapar', 'contact')
            ->type('1 Red Road', 'address')
            ->type('www.laravel.com', 'website')
            ->type('/usr/share/pixmaps/fedora-logo.png', 'complogo')
            ->type('/home/rajiv/rajivprj/public/xdata/ppt/ibm.pdf', 'compppt')
            ->press('Confirm Reservation')
            ->seePageIs($event_url);

	}

}


