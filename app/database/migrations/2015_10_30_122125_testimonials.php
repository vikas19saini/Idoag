<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Testimonials extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('testimonials', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('company_name');
            $table->text('website');
            $table->text('name');
            $table->text('designation');
            $table->text('image');
            $table->text('description');
            $table->text('email');
            $table->boolean('status')->default(false);
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
        Schema::drop('testimonials');
	}

}
