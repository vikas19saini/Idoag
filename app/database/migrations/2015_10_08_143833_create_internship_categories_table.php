<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternshipCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('internship_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->text('slug');
            $table->boolean('status')->default(0);
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
        Schema::drop('internship_categories');
	}

}
