<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBrandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('brands', function(Blueprint $table) {
            $table->integer('institution_id')->unsigned();
            $table->integer('city')->unsigned();
            $table->integer('state')->unsigned();
            $table->text('panindia');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
