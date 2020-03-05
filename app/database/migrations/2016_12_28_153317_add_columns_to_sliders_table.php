<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSlidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('sliders', function(Blueprint $table) {
            $table->text('link');
            $table->text('target');
            $table->integer('priority')->default(1);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('sliders', function(Blueprint $table)
        {
            $table->dropColumn('link');
            $table->dropColumn('target');
            $table->dropColumn('priority');
        });
    }

}
