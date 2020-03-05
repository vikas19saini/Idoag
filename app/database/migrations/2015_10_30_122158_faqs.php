<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Faqs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('faqs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('question');
            $table->text('answer');
            $table->text('orderno');
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
        Schema::drop('faqs');
	}

}
