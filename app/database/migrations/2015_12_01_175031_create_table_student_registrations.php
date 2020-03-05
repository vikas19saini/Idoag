<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentRegistrations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('student_registrations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('college');
            $table->text('state');
            $table->text('city');
            $table->text('person_name');
            $table->text('person_designation');
            $table->text('person_email');
            $table->text('person_mobile');
            $table->text('name');
            $table->text('email');
            $table->text('mobile');
            $table->boolean('status')->default(false);
            $table->text('comments');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('student_registrations');
	}

}
