<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('posts', function(Blueprint $table)
        {
            $table->text('short_description')->after('offer_value')->nullable();
            $table->time('time_from')->after('offer_value')->nullable();
            $table->time('time_to')->after('offer_value')->nullable();
            $table->text('registration_url')->after('offer_value')->nullable();
            $table->boolean('isfree')->after('offer_value')->nullable();
            $table->text('contact_details')->after('offer_value')->nullable();
            $table->integer('positions')->after('offer_value')->default(0);
            $table->boolean('stipend')->after('offer_value')->default(0);
            $table->integer('amount')->after('offer_value')->default(0);
            $table->bigInteger('visits')->after('amount')->default(0);
            $table->text('question1')->after('visits')->nullable();
            $table->text('question2')->after('question1')->nullable();
            $table->text('question3')->after('question2')->nullable();
            $table->text('question4')->after('question3')->nullable();
            $table->text('question5')->after('question4')->nullable();
            $table->text('question6')->after('question5')->nullable();

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
