<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('compdetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('compname');
			$table->string('compemail');
			$table->string('compaddr');
			$table->string('compweb');
			$table->string('compcontact');
			$table->string('complogo');
			$table->string('compppt');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('compdetails');
	}

}
