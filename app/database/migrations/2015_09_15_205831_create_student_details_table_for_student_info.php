<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDetailsTableForStudentInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_details', function($table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->string('aboutme')->nullable();
			$table->string('interests')->nullable();
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
		Schema::drop('student_details');
	}


}
