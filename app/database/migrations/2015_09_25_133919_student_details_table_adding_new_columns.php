<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentDetailsTableAddingNewColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->string('name')->after('user_id')->nullable();
			$table->string('email')->nullable();
			$table->string('institution')->nullable();
			$table->string('course')->nullable();
			$table->string('card_number')->nullable();
			$table->string('dob')->nullable();

		});	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_details', function(Blueprint $table)
		{
			$table->dropColumn('name');
			$table->dropColumn('email');
			$table->dropColumn('institution');
			$table->dropColumn('course');
			$table->dropColumn('card_number');
			$table->dropColumn('dob');
		});	
	}

}
