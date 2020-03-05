<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		Sentry::getUserProvider()->create(array(
	        'email'    => 'admin@idoag.com',
	        'password' => 'admin123',
	        'first_name' => 'admin',
	        'last_name' => 'idoag',
	        'activated' => 1,
	    ));
	    
	}

}
