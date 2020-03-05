<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('institutions', function(Blueprint $table) {
            $table->text('coverimage')->after('status')->nullable();
            $table->text('color1')->after('status')->nullable();
            $table->text('facebook')->after('status')->nullable();
            $table->text('twitter')->after('status')->nullable();
            $table->text('url')->after('status')->nullable();
            $table->text('logo')->after('status')->nullable();
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
