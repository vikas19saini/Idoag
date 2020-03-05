<?php

//Get Total Subscribers
function arqam_mailpoet_total_subscribers(){
	if( class_exists( 'WYSIJA' ) ){
		$config = WYSIJA::get('config','model');
		$result = $config->getValue('total_subscribers');
		return $result;
	}
}

//Get Mail Lists
function arqam_mailpoet_get_lists(){
	if( class_exists( 'WYSIJA' ) ){
		$helper_form_engine = WYSIJA::get('form_engine', 'helper');
		$lists = $helper_form_engine->get_lists();
		return $lists ;
	}
}

//Get Subscribers of Specific List
function arqam_mailpoet_get_list_users( $list ){
	if( class_exists( 'WYSIJA' ) ){
		$model_user_list = WYSIJA::get('user_list', 'model');$query = 'SELECT COUNT(*) as count
			FROM ' . '[wysija]' . $model_user_list->table_name . '
			WHERE list_id = ' . $list ;

		$result = $model_user_list->query('get_res', $query);
        return $result[0][ 'count' ];
	}
}

?>