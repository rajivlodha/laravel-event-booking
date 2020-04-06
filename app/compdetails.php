<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class compdetails extends Model {

	//
	protected $table = 'compdetails';

	protected $fillable = array('compname','compemail','compaddr','compweb','compcontact','complogo','compppt');

}
