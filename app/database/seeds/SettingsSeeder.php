<?php

class SettingsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	
		Eloquent::unguard();
		
		Setting::create(array('title' => 'Idoag.com', 'logo' => 'logo.png'));
	    
	}

}
