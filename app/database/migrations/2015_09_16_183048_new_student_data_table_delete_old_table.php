<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewStudentDataTableDeleteOldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_data', function($table)
		{
			$table->increments('id');
			$table->string('card_number');
			$table->string('rollno');
			$table->string('rol_no')->nullable();
			$table->string('contact_number')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('dob')->nullable();
			$table->string('college_id')->nullable();
			$table->string('streamorcourse')->nullable();
			$table->string('validity_for_how_many_years')->nullable();
			$table->string('cluborgrouporsociety')->nullable();
			$table->string('residentordayscholar')->nullable();
			$table->string('date_of_issue')->nullable();
			$table->string('expiry_date')->nullable();
			$table->string('section')->nullable();
			$table->string('father_name')->nullable();
			$table->string('batch_year')->nullable();
			$table->string('program_duration')->nullable();
			$table->string('email_id')->nullable();
			$table->string('gender')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_data');
	}

}
