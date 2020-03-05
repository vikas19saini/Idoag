<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNewColumnsToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
            $table->text('public_id')->after('web_only')->nullable();
            $table->string('state')->after('public_id')->nullable();
            $table->string('city')->after('state')->nullable();
            $table->string('offer_type')->after('city')->nullable();
            $table->string('offer_value')->after('offer_type')->nullable();
            $table->string('voucher_type')->after('offer_value')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
            $table->dropColumn('public_id');
            $table->dropColumn('state');
            $table->dropColumn('city');
            $table->dropColumn('offer_type');
            $table->dropColumn('offer_value');
            $table->dropColumn('voucher_type');

		});
	}

}
