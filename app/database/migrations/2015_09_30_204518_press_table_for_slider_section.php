<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PressTableForSliderSection extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('press', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('link');
			$table->text('image');
			$table->boolean('activated')->default(0);
			
			$table->timestamps();
			$table->softDeletes();
			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
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
		Schema::drop('press');
	}

}
