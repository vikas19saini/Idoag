<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createadstable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ads', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('name');
            $table->text('image');
            $table->boolean('status')->default(false);
            $table->text('src');
            $table->date('expiry_date');
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
        Schema::drop('ads');
	}

}
