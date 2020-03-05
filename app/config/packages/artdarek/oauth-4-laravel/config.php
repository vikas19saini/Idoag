<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers 
	 */
	'consumers' => array(

		/**
		 * Facebook   commented Keys are for Production
		 */
        'Facebook' => array(
            'client_id'     =>  '1664606373750912',
            'client_secret' =>  '3ead2c16084ba7f7179474c1cf5397cf',
            'scope'         => array('email','user_location','user_friends'),
        ),		
        /**
		 * Google    commented Keys are for Production
		 */
		'Google' => array(
    		'client_id' 	=>'87850367450-jctbpkn2cr62uh3vdvknbj1vnvi64922.apps.googleusercontent.com', // '675531957702-05uq9nh3vbbeircasuabu2v52o6mkg4d.apps.googleusercontent.com',
			'client_secret' =>'nPXaEdLogqClH68jQQCAW5-M', // 'KuOABjBTsMBxLRbUrXevQupg',
    		'scope'         => array('userinfo_email', 'userinfo_profile'),
		),  
	)
);
