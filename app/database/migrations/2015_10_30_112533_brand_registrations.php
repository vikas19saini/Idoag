<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrandRegistrations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('brand_registrations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('brand_name');
            $table->text('website');
            $table->text('category');
            $table->text('name');
            $table->text('designation');
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
        Schema::drop('brand_registrations');
	}

}
