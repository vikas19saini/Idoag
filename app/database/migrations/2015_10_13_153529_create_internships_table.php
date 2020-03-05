<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('internships', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('post_id')->unsigned()->index();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name');
            $table->text('institution');
            $table->text('course');
            $table->text('cover_letter');
            $table->text('why_selected');
            $table->text('edu_degree_type');
            $table->text('edu_college');
            $table->text('edu_course');
            $table->text('edu_year');
            $table->text('exp_title');
            $table->text('exp_info');
            $table->text('exp_duration');
            $table->text('exp_year');
            $table->text('answer1');
            $table->text('answer2');
            $table->text('answer3');
            $table->text('answer4');
            $table->text('answer5');
            $table->text('answer6');
            $table->text('resume');
            $table->boolean('status')->default(false);
            $table->text('comments');
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
        Schema::drop('internships');
    }

}
