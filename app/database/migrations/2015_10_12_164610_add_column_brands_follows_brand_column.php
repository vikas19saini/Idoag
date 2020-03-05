<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBrandsFollowsBrandColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('brands_follows', function(Blueprint $table)
		{
			$table->string('brand')->after('id');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('brands_follows', function(Blueprint $table)
		{
			$table->dropColumn('brand');
		});
	}

}
