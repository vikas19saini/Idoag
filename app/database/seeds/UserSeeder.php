<?php

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{	
		Eloquent::unguard();
		
		$faker = Faker\Factory::create();
 
 
        for($i = 0; $i < 100; $i++){
		
			// Create the user
			$user = Sentry::createUser(array(
				'email'     => $faker->email,
				'password'  => 'password',
				'first_name' => $faker->name,
                'last_name' => $faker->lastName,
			));
	
			// Find the group using the group id
    		$usersGroup = Sentry::findGroupById(rand(2,4));

    		// Assign the group to the user
    		$user->addGroup($usersGroup);
        }
	    
	}

}
