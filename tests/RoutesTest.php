<?php

/** @test 

Here we test that all our routes are working fine and not producing any http errors
we check for a response 200 on all our urls, we need to make sure all our routes
are working fine before we deploy our project live.

*/


class RoutesTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testHomePage()
	{
		$response = $this->call('GET', '/');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testEventsPage()
	{
		$response = $this->call('GET', '/events/');
		$this->assertEquals(200, $response->getStatusCode());
	}


	public function testParticularEventPage()
	{
		$response = $this->call('GET', '/events/1');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testParticularBookingPage()
	{
		$response = $this->call('GET', '/book/1/1');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testAdminEmailPage()
	{
		$response = $this->call('GET', '/admail/');
		$this->assertEquals(200, $response->getStatusCode());
	}

	/*
		Here we test an ambigous url
	*/

	public function testErrorPage()
	{
		$response = $this->call('GET', '/xdft/');
		$this->assertEquals(404, $response->getStatusCode());
	}



/*



*/

}