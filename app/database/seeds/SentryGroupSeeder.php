<?php

class SentryGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->delete();
		
		Sentry::getGroupProvider()->create(array(
	        'name'     	=> 'Admins',
			'slug' 		=> 'admins'
	        ));
			
		Sentry::getGroupProvider()->create(array(
	        'name'     	=> 'Brands',
			'slug' 		=> 'brands'
	        ));
			
		Sentry::getGroupProvider()->create(array(
	        'name'     	=> 'Students',
			'slug' 		=> 'students'
	        ));
		
		Sentry::getGroupProvider()->create(array(
	        'name'      => 'Institutions',
			'slug' 		=> 'institutions'
	        ));
	}

}