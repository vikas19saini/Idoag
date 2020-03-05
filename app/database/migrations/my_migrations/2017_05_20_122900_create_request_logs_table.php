<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestLogsTable extends Migration {

    /**
     * Run the migration
     * @return void
     */
    public function up() {
	Schema::create('request_logs', function(Blueprint $table) { $table->increments('id');
	$table->text('request');
	$table->text('response');
	$table->string('code', 10);
	$table->integer('took_ms');
	$table->text('uri');
	$table->string('ip', 24);
	$table->text('session');
	$table->timestamps();
    	});
    }

    /**
     * Reverse the migration
     * @return void
     */
    public function down() {
	Schema::drop('request_logs');
    }
}
