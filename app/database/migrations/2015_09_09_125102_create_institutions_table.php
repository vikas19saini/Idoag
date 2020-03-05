<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstitutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('institutions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('name');
            $table->text('slug');
            $table->text('description');
            $table->text('image');
            $table->text('public_id')->nullable();
            $table->integer('priority');
            $table->boolean('status')->default(0);

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
		Schema::drop('institutions');
	}

}
