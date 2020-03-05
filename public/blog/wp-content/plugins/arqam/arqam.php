<?php
/*
	Plugin Name: Arqam
	Plugin URI: http://codecanyon.net/item/tielabs/5085289
	Description: WordPress Social Counter Plugin
	Author: TieLabs
	Version: 2.0.6
	Author URI: http://tielabs.com
*/

/*-----------------------------------------------------------------------------------*/
# Get Plugin Options and Transient
/*-----------------------------------------------------------------------------------*/

require_once( 'arqam-panel.php' );
require_once( 'inc/tumblr/tumblroauth.php' );
require_once( 'inc/500px/500pxoauth.php' );
require_once( 'inc/vine/vine.php' );
require_once( 'inc/mailpoet/mailpoet.php' );

if ( !class_exists( 'OAuthException' ) )
	require_once( 'inc/OAuth.php' );
	
define ('ARQAM_Plugin' , 'Arqam' );
define ('ARQAM_Plugin_ver' , '2.0.0' );

$arq_transient	=	get_transient( 'arq_counters' );
$arq_options	=	get_option   ( 'arq_options'  );

if( empty($arq_options)	){
	$arq_options = array();
}

if( empty($arq_transient) || (false ===  $arq_transient) ){
	$arq_transient = array();
}

$arq_data = array();
$arq_social_items = array( 'facebook', 'twitter', 'google', 'youtube', 'vimeo', 'dribbble', 'github', 'envato', 'soundcloud', 'behance', 'delicious', 'instagram', 'mailchimp', 'mailpoet', 'mymail', 'foursquare', 'linkedin', 'vk', 'tumblr', '500px', 'vine', 'pinterest', 'flickr', 'steam', 'spotify', 'twitch', 'mixcloud', 'goodreads', 'rss', 'posts', 'comments', 'groups', 'forums', 'members', 'topics', 'replies');

/*-----------------------------------------------------------------------------------*/
# Register and Enquee plugin's styles and scripts
/*-----------------------------------------------------------------------------------*/
function arqam_scripts_styles(){

	wp_register_style( 'arqam-style' , plugins_url('assets/style.css' , __FILE__) ) ;
	wp_enqueue_style ( 'arqam-style' );

	if( !is_admin()){
		wp_register_script( 'arqam-scripts', plugins_url('assets/js/scripts.js', __FILE__) , array( 'jquery' ), false, true );  
		wp_enqueue_script ( 'arqam-scripts' );
	}	
}
add_action( 'init', 'arqam_scripts_styles' );


/*-----------------------------------------------------------------------------------*/
# Load Text Domain
/*-----------------------------------------------------------------------------------*/
add_action('plugins_loaded', 'arqam_init');
function arqam_init() {
	load_plugin_textdomain( 'arq' , false, dirname( plugin_basename( __FILE__ ) ).'/languages' ); 
}


/*-----------------------------------------------------------------------------------*/
# Store Defaults settings
/*-----------------------------------------------------------------------------------*/
if ( is_admin() && isset($_GET['activate'] ) && $pagenow == 'plugins.php' ) {
	if( !get_option('arqam_active') ){
	
		$default_data = array(
			'social' => array(
				'facebook' 		=> array( 'text' => __( 'Fans', 		'arq' ), 	'id' => 'tielabs' ),
				'twitter' 		=> array( 'text' => __( 'Followers',	'arq' ), 	'id' => 'mo3aser'	),
				'google' 		=> array( 'text' => __( 'Followers',	'arq' )),
				'linkedin'  	=> array( 'text' => __( 'Followers',	'arq' )),
				'tumblr'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'500px'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'vine'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'pinterest'  	=> array( 'text' => __( 'Followers',	'arq' ),	'username' => 'mo3aser'),
				'spotify'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'twitch'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'mixcloud'  	=> array( 'text' => __( 'Followers',	'arq' )),
				'dribbble' 		=> array( 'text' => __( 'Followers',	'arq' )),
				'envato' 		=> array( 'text' => __( 'Followers',	'arq' ),	'id' => 'TieLabs',	'site' => 'themeforest'),
				'github'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'soundcloud'  	=> array( 'text' => __( 'Followers',	'arq' )),
				'behance'  		=> array( 'text' => __( 'Followers',	'arq' )),
				'instagram'  	=> array( 'text' => __( 'Followers',	'arq' )),
				'delicious'  	=> array( 'text' => __( 'Followers',	'arq' )),
				'youtube'		=> array( 'text' => __( 'Subscribers',	'arq' ),	'id' => 'TEAMMESAI', 'type' => 'User'),
				'vimeo' 		=> array( 'text' => __( 'Subscribers',	'arq' )),
				'mailchimp'  	=> array( 'text' => __( 'Subscribers',	'arq' )),
				'mailpoet'  	=> array( 'text' => __( 'Subscribers',	'arq' )),
				'mymail'  		=> array( 'text' => __( 'Subscribers',	'arq' )),
				'rss'  			=> array( 'text' => __( 'Subscribers',	'arq' )),
				'foursquare'  	=> array( 'text' => __( 'Friends',		'arq' )),
				'goodreads'  	=> array( 'text' => __( 'Friends',		'arq' )),
				'vk'  			=> array( 'text' => __( 'Members',		'arq' ),	'id' => 'applevk' ),
				'flickr'  		=> array( 'text' => __( 'Members',		'arq' )),
				'steam'  		=> array( 'text' => __( 'Members',		'arq' )),
				'members'  		=> array( 'text' => __( 'Members',		'arq' )),
				'comments'  	=> array( 'text' => __( 'Comments',		'arq' )),
				'posts' 	 	=> array( 'text' => __( 'Posts',		'arq' )),
				'groups'  		=> array( 'text' => __( 'Groups',		'arq' )),
				'forums'  		=> array( 'text' => __( 'Forums',		'arq' )),
				'toptcs'  		=> array( 'text' => __( 'Topics',		'arq' )),
				'replies' 	 	=> array( 'text' => __( 'Replies',		'arq' ))
			),
			'cache' => 5
		);
		
		update_option( 'arq_options',		$default_data);
		update_option( 'arqam_active',		ARQAM_Plugin_ver );
	}  
}


/*-----------------------------------------------------------------------------------*/
# Get Data From API's
/*-----------------------------------------------------------------------------------*/
function arq_remote_get( $url, $json = true, $args = array( 'timeout' => 18 , 'sslverify' => false ) ) {

	$get_request = preg_replace ( '/\s+/', '', $url);
	$get_request = wp_remote_get( $url , $args );

	if( is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'arqam' && !empty( $_REQUEST['debug'] ) ) {
		print_R( $get_request );
		return 0;
	}

	$request 	 = wp_remote_retrieve_body( $get_request );

	if( $json ){
		$request = @json_decode( $request , true );
	}
	return $request;  
}


/*-----------------------------------------------------------------------------------*/
# Update Options and Transient
/*-----------------------------------------------------------------------------------*/
function arq_update_count( $data ){
	global $arq_options, $arq_transient ;
	
	if( empty( $arq_options['cache'] ) || !is_int($arq_options['cache']) )
		$cache = 2 ;
	else $cache = $arq_options['cache'] ;
	
	if( is_array($data) ){
		foreach( $data as $item => $value ){
			$arq_transient[$item] = $value;
			$arq_options['data'][$item] = $value;
		}
	}
	set_transient( 'arq_counters', $arq_transient , $cache*60*60 );
	update_option( 'arq_options' , $arq_options );
}


/*-----------------------------------------------------------------------------------*/
# Number Format Function
/*-----------------------------------------------------------------------------------*/
function arq_format_num( $number ){
	if( !is_numeric( $number ) ) return $number ;
	
	if($number >= 1000000){
		return round( ($number/1000)/1000 , 1) . "M";
	}elseif($number >= 100000){
		return round( $number/1000, 0) . "k";
	}else{
		return @number_format( $number );
	}
}


/*-----------------------------------------------------------------------------------*/
# Get Social Counters
/*-----------------------------------------------------------------------------------*/
function arq_get_counters( $layout='', $columns = 3, $dark = false, $width = '', $block_width = '', $inside_widget = false ){
	global $arq_data, $arq_options, $arq_social_items ;

	if 	   ( $layout == 'gray' ) 			$class = " arq-outer-frame";
	elseif ( $layout == 'colored' ) 		$class = " arq-outer-frame arq-colored";
	elseif ( $layout == 'colored_border' )	$class = " arq-outer-frame arq-border-colored";
	elseif ( $layout == 'flat' ) 			$class = " arq-flat";
	else 									$class = " arq-metro arq-flat arq-col3";

	if( $layout != 'metro' ){
		$class .= ' arq-col'.$columns;
	}
	
	if( $dark ){ 
		$class .= ' arq-dark';
	}
	
	if( !empty($inside_widget) ){
		$class .= ' inside-widget';
	}

	if( !empty($width) ){
		if( strpos( $width, 'px') === false && strpos( $width, '%') === false ){
			$width .= 'px';
		}
		$width = ' style="width:'.$width.';"';
	}

	if( !empty($block_width) ){
		if( strpos( $block_width, 'px') === false && strpos( $block_width, '%') === false ){
			$block_width .= 'px';
		}
		$block_width = ' style="width:'.$block_width.';"';
	}
	
	$new_window = ' target="_blank" ';
	
	if( !empty( $arq_options['sort'] ) && is_array( $arq_options['sort'] )){
		$arq_sort_items = $arq_options['sort'];
		$arq_new_items 	= array_diff ( $arq_social_items, $arq_sort_items );

		if( !empty( $arq_new_items ) ){
			$arq_sort_items = array_merge( $arq_sort_items, $arq_new_items );
		}
	}
	else{
		$arq_sort_items		= $arq_social_items;
	}

	?>
	<div class="arqam-widget-counter<?php echo $class ?>"<?php echo $block_width; ?>>
		<ul>	
	<?php

foreach ( $arq_sort_items as $arq_item ){

	switch ( $arq_item ) {
		case 'facebook': 
		if( !empty($arq_options['social']['facebook']['id']) ){
			$text = __( 'Fans' , 'arq' );
			if( !empty($arq_options['social']['facebook']['text']) ) $text = $arq_options['social']['facebook']['text'];
		?>
			<li class="arq-facebook"<?php echo $width ?>>
				<a href="http://www.facebook.com/<?php echo $arq_options['social']['facebook']['id']; ?>"<?php echo $new_window ?>>
					<i class="arqicon-facebook"></i>
					<span><?php echo arq_format_num( arq_facebook_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'twitter':
		if( !empty($arq_options['social']['twitter']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['twitter']['text']) ) $text = $arq_options['social']['twitter']['text'];
		?>
			<li class="arq-twitter"<?php echo $width ?>>
				<a href="http://twitter.com/<?php echo $arq_options['social']['twitter']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-twitter"></i>
					<span><?php echo arq_format_num( arq_twitter_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'google':
		if( !empty($arq_options['social']['google']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['google']['text']) ) $text = $arq_options['social']['google']['text'];
		?>
			<li class="arq-google"<?php echo $width ?>>
				<a href="http://plus.google.com/<?php echo $arq_options['social']['google']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-google-plus"></i>
					<span><?php echo arq_format_num( arq_google_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'youtube':	
		if( !empty($arq_options['social']['youtube']['id']) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['youtube']['text']) ) $text = $arq_options['social']['youtube']['text'];
			
			$type = 'user';
			if( !empty($arq_options['social']['youtube']['type']) && $arq_options['social']['youtube']['type'] == 'Channel' ) $type = 'channel';
		?>
			<li class="arq-youtube"<?php echo $width ?>>
				<a href="http://youtube.com/<?php echo $type ?>/<?php echo $arq_options['social']['youtube']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-youtube"></i>
					<span><?php echo arq_format_num(  arq_youtube_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'vimeo':
 		if( !empty($arq_options['social']['vimeo']['id']) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['vimeo']['text']) ) $text = $arq_options['social']['vimeo']['text'];
		?>
			<li class="arq-vimeo"<?php echo $width ?>>
				<a href="https://vimeo.com/channels/<?php echo $arq_options['social']['vimeo']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-vimeo"></i> 
					<span><?php echo arq_format_num( arq_vimeo_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'github':
 		if( !empty($arq_options['social']['github']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['github']['text']) ) $text = $arq_options['social']['github']['text'];
		?>
			<li class="arq-github"<?php echo $width ?>>
				<a href="https://github.com/<?php echo $arq_options['social']['github']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-github"></i> 
					<span><?php echo arq_format_num( arq_github_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'dribbble':
 		if( !empty($arq_options['social']['dribbble']['id']) ){ 
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['dribbble']['text']) ) $text = $arq_options['social']['dribbble']['text'];
		?>
			<li class="arq-dribbble"<?php echo $width ?>>
				<a href="http://dribbble.com/<?php echo $arq_options['social']['dribbble']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-dribbble"></i>
					<span><?php echo arq_format_num( arq_dribbble_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'envato': 
		if( !empty($arq_options['social']['envato']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['envato']['text']) ) $text = $arq_options['social']['envato']['text'];
		?>
			<li class="arq-envato"<?php echo $width ?>>
				<a href="http://<?php echo $arq_options['social']['envato']['site'] ?>.net/user/<?php echo $arq_options['social']['envato']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-envato"></i>
					<span><?php echo arq_format_num( arq_envato_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'soundcloud': 
		if( !empty($arq_options['social']['soundcloud']['id']) && !empty( $arq_options['social']['soundcloud']['api'] ) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['soundcloud']['text']) ) $text = $arq_options['social']['soundcloud']['text'];
		?>
			<li class="arq-soundcloud"<?php echo $width ?>>
				<a href="http://soundcloud.com/<?php echo $arq_options['social']['soundcloud']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-soundcloud"></i> 
					<span><?php echo arq_format_num( arq_soundcloud_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'behance': 
		if( !empty($arq_options['social']['behance']['id']) && !empty( $arq_options['social']['behance']['api'] ) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['behance']['text']) ) $text = $arq_options['social']['behance']['text'];
		?>
			<li class="arq-behance"<?php echo $width ?>>
				<a href="http://www.behance.net/<?php echo $arq_options['social']['behance']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-behance"></i> 
					<span><?php echo arq_format_num( arq_behance_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'delicious': 
		if( !empty($arq_options['social']['delicious']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['delicious']['text']) ) $text = $arq_options['social']['delicious']['text'];
		?>
			<li class="arq-delicious"<?php echo $width ?>>
				<a href="http://delicious.com/<?php echo $arq_options['social']['delicious']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-delicious"></i>
					<span><?php echo arq_format_num( arq_delicious_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'instagram': 
		if( !empty($arq_options['social']['instagram']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['instagram']['text']) ) $text = $arq_options['social']['instagram']['text'];
		?>
			<li class="arq-instagram"<?php echo $width ?>>
				<a href="http://instagram.com/<?php echo $arq_options['social']['instagram']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-instagram"></i>
					<span><?php echo arq_format_num( arq_instagram_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'mailchimp': 
		if( !empty($arq_options['social']['mailchimp']['id']) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['mailchimp']['text']) ) $text = $arq_options['social']['mailchimp']['text'];
		?>
			<li class="arq-mailchimp"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['mailchimp']['url'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-envelope"></i>
					<span><?php echo arq_format_num( arq_mailchimp_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'mailpoet': 
		if( !empty($arq_options['social']['mailpoet']['list']) && class_exists( 'WYSIJA' ) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['mailpoet']['text']) ) $text = $arq_options['social']['mailpoet']['text'];
		?>
			<li class="arq-mailpoet"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['mailpoet']['url'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-envelope"></i>
					<span><?php echo arq_format_num( arq_mailpoet_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'mymail': 
		if( !empty($arq_options['social']['mymail']['list']) && class_exists( 'mymail' ) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['mymail']['text']) ) $text = $arq_options['social']['mymail']['text'];
		?>
			<li class="arq-mymail"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['mymail']['url'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-envelope"></i>
					<span><?php echo arq_format_num( arq_mymail_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'foursquare': 
		if( !empty($arq_options['social']['foursquare']['id']) ){
			$text = __( 'Friends' , 'arq' );
			if( !empty($arq_options['social']['foursquare']['text']) ) $text = $arq_options['social']['foursquare']['text'];
		?>
			<li class="arq-foursquare"<?php echo $width ?>>
				<a href="http://foursquare.com/<?php echo $arq_options['social']['foursquare']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-foursquare"></i>
					<span><?php echo arq_format_num( arq_foursquare_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'linkedin': 
		if( ( !empty($arq_options['social']['linkedin']['type']) && $arq_options['social']['linkedin']['type'] == 'Company' && !empty($arq_options['social']['linkedin']['id']) ) ||
			( !empty($arq_options['social']['linkedin']['type']) && $arq_options['social']['linkedin']['type'] == 'Group'   && !empty($arq_options['social']['linkedin']['group']) )	){
			
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['linkedin']['text']) ) $text = $arq_options['social']['linkedin']['text'];
		
			if( !empty( $arq_options['social']['linkedin']['type'] ) &&  $arq_options['social']['linkedin']['type'] == 'Group' )
				$linkedin_link = $arq_options['social']['linkedin']['group'];
			else 
				$linkedin_link = $arq_options['social']['linkedin']['id'];

		?>
			<li class="arq-linkedin"<?php echo $width ?>>
				<a href="<?php echo $linkedin_link ?>"<?php echo $new_window ?>>
					<i class="arqicon-linkedin"></i>
					<span><?php echo arq_format_num( arq_linkedin_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'vk': 
		if( !empty($arq_options['social']['vk']['id']) ){
			$text = __( 'Members' , 'arq' );
			if( !empty($arq_options['social']['vk']['text']) ) $text = $arq_options['social']['vk']['text'];
		?>
			<li class="arq-vk"<?php echo $width ?>>
				<a href="http://vk.com/<?php echo $arq_options['social']['vk']['id'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-vk"></i>
					<span><?php echo arq_format_num( arq_vk_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'tumblr': 
		if( !empty($arq_options['social']['tumblr']['hostname']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['tumblr']['text']) ) $text = $arq_options['social']['tumblr']['text'];
		?>
			<li class="arq-tumblr"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['tumblr']['hostname'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-tumblr"></i>
					<span><?php echo arq_format_num( arq_tumblr_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case '500px': 
		if( !empty($arq_options['social']['500px']['username']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['500px']['text']) ) $text = $arq_options['social']['500px']['text'];
		?>
			<li class="arq-fivehundredpx"<?php echo $width ?>>
				<a href="http://500px.com/<?php echo $arq_options['social']['500px']['username'] ?>"<?php echo $new_window ?>>
					<i class="arqicon-500px"></i>
					<span><?php echo arq_format_num( arq_500px_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'vine': 
		if( !empty($arq_options['social']['vine']['url']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['vine']['text']) ) $text = $arq_options['social']['vine']['text'];
		?>
			<li class="arq-vine"<?php echo $width ?>>
				<a href="<?php echo esc_url($arq_options['social']['vine']['url']) ?>"<?php echo $new_window ?>>
					<i class="arqicon-vine"></i>
					<span><?php echo arq_format_num( arq_vine_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'pinterest': 
		if( !empty($arq_options['social']['pinterest']['username']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['pinterest']['text']) ) $text = $arq_options['social']['pinterest']['text'];
		?>
			<li class="arq-pinterest"<?php echo $width ?>>
				<a href="http://www.pinterest.com/<?php echo $arq_options['social']['pinterest']['username'] ?>/"<?php echo $new_window ?>>
					<i class="arqicon-pinterest"></i>
					<span><?php echo arq_format_num( arq_pinterest_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'flickr': 
		if( !empty($arq_options['social']['flickr']['id']) ){
			$text = __( 'Members' , 'arq' );
			if( !empty($arq_options['social']['flickr']['text']) ) $text = $arq_options['social']['flickr']['text'];
		?>
			<li class="arq-flickr"<?php echo $width ?>>
				<a href="https://www.flickr.com/groups/<?php echo $arq_options['social']['flickr']['id'] ?>/"<?php echo $new_window ?>>
					<i class="arqicon-flickr"></i>
					<span><?php echo arq_format_num( arq_flickr_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'steam': 
		if( !empty($arq_options['social']['steam']['group']) ){
			$text = __( 'Members' , 'arq' );
			if( !empty($arq_options['social']['steam']['text']) ) $text = $arq_options['social']['steam']['text'];
		?>
			<li class="arq-steam"<?php echo $width ?>>
				<a href="http://steamcommunity.com/groups/<?php echo $arq_options['social']['steam']['group'] ?>/"<?php echo $new_window ?>>
					<i class="arqicon-steam"></i>
					<span><?php echo arq_format_num( arq_steam_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'spotify': 
		if( !empty($arq_options['social']['spotify']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['spotify']['text']) ) $text = $arq_options['social']['spotify']['text'];
		?>
			<li class="arq-spotify"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['spotify']['id'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-spotify"></i>
					<span><?php echo arq_format_num( arq_spotify_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'goodreads': 
		if( !empty($arq_options['social']['goodreads']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['goodreads']['text']) ) $text = $arq_options['social']['goodreads']['text'];
		?>
			<li class="arq-goodreads"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['goodreads']['id'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-goodreads">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="45" height="29" viewBox="0 0 430.117 430.118" xml:space="preserve">
							<path id="Goodreads" d="M213.901,302.077c46.55-0.388,79.648-23.671,99.288-69.843h1.026v70.422c0,5.25-0.346,13.385-1.026,24.445
								c-1.4,11.444-5.144,23.766-11.216,36.959c-6.081,12.414-15.9,22.995-29.435,31.718c-13.391,9.502-32.063,14.449-56.047,14.841
								c-23.102,0-42.638-6.016-58.63-18.043c-16.344-11.835-25.893-31.045-28.665-57.619h-20.32c2.084,34.527,13.105,59.169,33.08,73.917
								c19.453,14.16,44.132,21.244,74.02,21.244c29.522,0,52.549-5.525,69.051-16.591c16.326-10.669,28.05-23.966,35.181-39.871
								c7.122-15.905,11.379-31.045,12.76-45.393c1.055-14.365,1.568-24.642,1.568-30.849V6.987h-20.33v64.021h-1.026
								c-7.827-23.468-20.764-41.22-38.84-53.254C256.102,5.922,235.949,0,213.892,0c-38.41,0.779-67.591,15.619-87.563,44.529
								c-20.507,28.707-30.747,64.121-30.747,106.218c0,43.266,9.724,79.056,29.176,107.38
								C144.409,287.044,174.11,301.689,213.901,302.077z M140.414,60.245c15.971-26.194,40.463-39.771,73.488-40.741
								c33.874,0.975,58.964,14.165,75.308,39.582c16.326,25.419,24.493,55.972,24.493,91.67c0,35.701-8.167,66.058-24.493,91.083
								c-16.344,26.589-41.434,40.165-75.308,40.744c-31.967-0.588-56.304-13.782-72.972-39.577
								c-16.855-25.029-25.277-55.778-25.277-92.254C115.648,116.605,123.901,86.434,140.414,60.245z"/>
						</svg>
					</i>
					<span><?php echo arq_format_num( arq_goodreads_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'twitch': 
		if( !empty($arq_options['social']['twitch']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['twitch']['text']) ) $text = $arq_options['social']['twitch']['text'];
		?>
			<li class="arq-twitch"<?php echo $width ?>>
				<a href="http://www.twitch.tv/<?php echo $arq_options['social']['twitch']['id'] ?>/profile"<?php echo $new_window ?>>
					<i class="arqicon-twitch"></i>
					<span><?php echo arq_format_num( arq_twitch_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'mixcloud': 
		if( !empty($arq_options['social']['mixcloud']['id']) ){
			$text = __( 'Followers' , 'arq' );
			if( !empty($arq_options['social']['mixcloud']['text']) ) $text = $arq_options['social']['mixcloud']['text'];
		?>
			<li class="arq-mixcloud"<?php echo $width ?>>
				<a href="https://www.mixcloud.com/<?php echo $arq_options['social']['mixcloud']['id'] ?>/"<?php echo $new_window ?>>
					<i class="arqicon-mixcloud">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-3 0 31.5 15.375" xml:space="preserve">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M10.778,13.746c-1.771,0-3.543,0-5.314,0c-2.071-0.001-3.775-1.411-4.157-3.439
								C0.902,8.161,2.268,6.034,4.396,5.525c0.295-0.07,0.447-0.19,0.564-0.475c1.035-2.527,3.624-4.064,6.364-3.803
								c2.702,0.259,4.955,2.301,5.467,4.993c0.078,0.409,0.214,0.61,0.635,0.762c1.506,0.542,2.389,2.09,2.193,3.706
								c-0.187,1.533-1.44,2.794-2.996,2.99c-0.341,0.043-0.689,0.044-1.034,0.045C13.985,13.748,12.382,13.746,10.778,13.746z
								 M16.855,8.476c-0.073,0.291-0.129,0.556-0.208,0.814c-0.149,0.493-0.564,0.739-1.007,0.611c-0.443-0.128-0.635-0.55-0.511-1.06
								c0.091-0.374,0.188-0.756,0.208-1.138c0.131-2.666-1.909-4.84-4.581-4.903C8.96,2.758,7.155,3.896,6.489,5.502
								C6.557,5.528,6.622,5.56,6.69,5.581C7.291,5.767,7.815,6.082,8.28,6.5c0.27,0.242,0.414,0.53,0.298,0.896
								C8.387,8,7.718,8.135,7.219,7.675C6.347,6.87,5.119,6.729,4.11,7.318c-1.008,0.589-1.497,1.746-1.22,2.883
								c0.291,1.189,1.357,1.979,2.691,1.979c3.458,0.002,6.916,0.002,10.374-0.002c0.198,0,0.398-0.021,0.593-0.059
								c0.777-0.148,1.438-0.88,1.506-1.652C18.133,9.575,17.678,8.805,16.855,8.476z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M24.837,10.129c-0.026,1.729-0.449,3.227-1.338,4.585
								c-0.196,0.299-0.463,0.46-0.82,0.398c-0.591-0.102-0.851-0.71-0.521-1.229c0.506-0.795,0.855-1.645,1.003-2.578
								c0.261-1.649-0.057-3.178-0.935-4.595c-0.081-0.132-0.164-0.273-0.196-0.422c-0.079-0.369,0.126-0.729,0.464-0.867
								c0.339-0.138,0.744-0.034,0.951,0.272c0.757,1.121,1.201,2.357,1.337,3.703C24.811,9.678,24.824,9.96,24.837,10.129z"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M22.211,10.347c-0.01,1.046-0.312,2.096-0.929,3.053
								c-0.276,0.43-0.752,0.573-1.129,0.343c-0.404-0.248-0.49-0.727-0.216-1.177c0.938-1.536,0.945-3.076,0.018-4.619
								c-0.287-0.478-0.211-0.958,0.197-1.203c0.396-0.238,0.856-0.095,1.147,0.365C21.906,8.069,22.21,9.119,22.211,10.347z"/>
						</svg>
					</i>
					<span><?php echo arq_format_num( arq_mixcloud_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;

		case 'rss': 
		if( !empty($arq_options['social']['rss']['url']) ){
			$text = __( 'Subscribers' , 'arq' );
			if( !empty($arq_options['social']['rss']['text']) ) $text = $arq_options['social']['rss']['text'];
		?>
			<li class="arq-rss"<?php echo $width ?>>
				<a href="<?php echo esc_url( $arq_options['social']['rss']['url'] ) ?>"<?php echo $new_window ?>>
					<i class="arqicon-feed"></i>
					<span><?php echo arq_format_num( arq_rss_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'posts': 
		if( isset($arq_options['social']['posts']['active']) ){
			$text = __( 'Posts' , 'arq' );
			if( !empty($arq_options['social']['posts']['text']) ) $text = $arq_options['social']['posts']['text'];
		?>
			<li class="arq-posts"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['posts']['url'])){?> href="<?php echo esc_url( $arq_options['social']['posts']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-file-text"></i>
					<span><?php echo arq_format_num( arq_posts_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'comments': 
		if( isset($arq_options['social']['comments']['active']) ){
			$text = __( 'Comments' , 'arq' );
			if( !empty($arq_options['social']['comments']['text']) ) $text = $arq_options['social']['comments']['text'];
		?>
			<li class="arq-comments"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['comments']['url'])){?> href="<?php echo esc_url( $arq_options['social']['comments']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-comments"></i>
					<span><?php echo arq_format_num( arq_comments_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'members': 
		if( isset($arq_options['social']['members']['active']) ){
			$text = __( 'Members' , 'arq' );
			if( !empty($arq_options['social']['members']['text']) ) $text = $arq_options['social']['members']['text'];
		?>
			<li class="arq-members"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['members']['url'])){?> href="<?php echo esc_url( $arq_options['social']['members']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-user"></i>
					<span><?php echo arq_format_num( arq_members_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'groups': 
		if( isset($arq_options['social']['groups']['active']) ){
			$text = __( 'Groups' , 'arq' );
			if( !empty($arq_options['social']['groups']['text']) ) $text = $arq_options['social']['groups']['text'];
		?>
			<li class="arq-groups"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['groups']['url'])){?> href="<?php echo esc_url( $arq_options['social']['groups']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-group"></i>
					<span><?php echo arq_format_num( arq_groups_count() ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'forums': 
		if( isset($arq_options['social']['forums']['active']) ){
			$text = __( 'Forums' , 'arq' );
			if( !empty($arq_options['social']['forums']['text']) ) $text = $arq_options['social']['forums']['text'];
		?>
			<li class="arq-forums"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['forums']['url'])){?> href="<?php echo esc_url( $arq_options['social']['forums']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-folder-open"></i>
					<span><?php echo arq_format_num( arq_bbpress_count( 'forums' ) ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		case 'topics': 
		if( isset($arq_options['social']['topics']['active']) ){
			$text = __( 'Topics' , 'arq' );
			if( !empty($arq_options['social']['topics']['text']) ) $text = $arq_options['social']['topics']['text'];
		?>
			<li class="arq-topics"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['topics']['url'])){?> href="<?php echo esc_url( $arq_options['social']['topics']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-copy"></i>
					<span><?php echo arq_format_num( arq_bbpress_count( 'topics' ) ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;		
		case 'replies': 
		if( isset($arq_options['social']['replies']['active']) ){
			$text = __( 'Replies' , 'arq' );
			if( !empty($arq_options['social']['replies']['text']) ) $text = $arq_options['social']['replies']['text'];
		?>
			<li class="arq-replies"<?php echo $width ?>>
				<a<?php if( !empty($arq_options['social']['replies']['url'])){?> href="<?php echo esc_url( $arq_options['social']['replies']['url'] ) ?>"<?php echo $new_window; }?>>
					<i class="arqicon-commenting"></i>
					<span><?php echo arq_format_num( arq_bbpress_count( 'replies' ) ) ?></span>
					<small><?php echo $text; ?></small>
				</a>
			</li>
		<?php
		}
		break;
		
	}
	
} //End Foreach ?>
							
			</ul>
		</div>
		<!-- Arqam Social Counter Plugin : http://codecanyon.net/user/TieLabs/portfolio?ref=TieLabs -->
<?php
	if( !empty ($arq_data) ){
		arq_update_count( $arq_data );
	}
}


/*-----------------------------------------------------------------------------------*/
# Functions to Get Counters
/*-----------------------------------------------------------------------------------*/
/* Twitter Followers */
function arq_twitter_count() {
	global $arq_data, $arq_options, $arq_transient;
	
	if( !empty($arq_transient['twitter']) ){
		$result = $arq_transient['twitter'];
	}
	elseif( empty($arq_transient['twitter']) && !empty($arq_data) && !empty( $arq_options['data']['twitter'] )  ){
		$result = $arq_options['data']['twitter'];
	}
	else{
		$id 			= $arq_options['social']['twitter']['id'];
		$token 			= get_option('arqam_TwitterToken');

		// we have bearer token wether we obtained it from API or from options
		$args = array(
			'httpversion' 	=> '1.1',
			'blocking' 		=> true,
			'timeout'		=> 18,
			'headers' 		=> array(
				'Authorization' => "Bearer $token"
			)
		);
	 
		add_filter('https_ssl_verify', '__return_false');
		$api_url 	= "https://api.twitter.com/1.1/users/show.json?screen_name=$id";
		$response 	= arq_remote_get( $api_url, true, $args );
	 
		if( !empty( $response['followers_count'] ) )
			$result = $response['followers_count'];

		if( !empty( $result ) ) //To update the stored data
			$arq_data['twitter'] = $result; 
		
		if( empty( $result ) && !empty( $arq_options['data']['twitter'] ) ) //Get the stored data
			$result = $arq_options['data']['twitter'];	
	}
	return $result;
}

/* Facebook Fans */
function arq_facebook_count(){
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['facebook']) ){
		$result = $arq_transient['facebook'];
	}
	elseif( empty($arq_transient['facebook']) && !empty($arq_data) && !empty( $arq_options['data']['facebook'] ) ){
		$result = $arq_options['data']['facebook'];
	}
	else{
		$id = $arq_options['social']['facebook']['id'];
		try {
			$access_token 	= get_option( 'facebook_access_token' ) ;
			$data 			= @arq_remote_get( "https://graph.facebook.com/v2.0/$id?access_token=$access_token&fields=likes" );			
			$result 		= (int) $data['likes'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['facebook'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['facebook'] ) ) //Get the stored data
			$result = $arq_options['data']['facebook'];	
	}
	return $result;
}

/* Google+ Followers */
function arq_google_count(){
	global $arq_data, $arq_options, $arq_transient;
	
	if( !empty($arq_transient['google']) ){
		$result = $arq_transient['google'];
	}
	elseif( empty($arq_transient['google']) && !empty($arq_data) && !empty( $arq_options['data']['google'] )  ){
		$result = $arq_options['data']['google'];
	}
	else{
		$id 			= $arq_options['social']['google']['id'];
		$key 			= $arq_options['social']['google']['key'];
		$googleplus_id 	= 'https://plus.google.com/' . $id;
		try {		
			// Get googleplus data.
			$googleplus_data = arq_remote_get( 'https://www.googleapis.com/plus/v1/people/'. $id .'?key=' . $key );

			if ( isset( $googleplus_data['circledByCount'] ) ) {
				$googleplus_count 	= (int) $googleplus_data['circledByCount'] ;
				$result 			= $googleplus_count;
			}
            
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['google'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['google'] ) ) //Get the stored data
			$result = $arq_options['data']['google'];	
	}
	return $result;
}

/* Youtube Subscribers */
function arq_youtube_count(){
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['youtube']) ){
		$result = $arq_transient['youtube'];
	}
	elseif( empty($arq_transient['youtube']) && !empty($arq_data) && !empty( $arq_options['data']['youtube'] )  ){
		$result = $arq_options['data']['youtube'];
	}
	else{
		$id  = $arq_options['social']['youtube']['id'];
		$api = $arq_options['social']['youtube']['key'];
		try {		
			if( !empty($arq_options['social']['youtube']['type']) && $arq_options['social']['youtube']['type'] == 'Channel' ){
				$data = @arq_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=$id&key=$api");
			}else{
				$data = @arq_remote_get("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=$id&key=$api");
			}
			$result = (int) $data['items'][0]['statistics']['subscriberCount'];	

		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['youtube'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['youtube'] ) ) //Get the stored data
			$result = $arq_options['data']['youtube'];	
	}
	return $result;	
}

/* Vimeo Subscribers */
function arq_vimeo_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['vimeo']) ){
		$result = $arq_transient['vimeo'];
	}
	elseif( empty($arq_transient['vimeo']) && !empty($arq_data) && !empty( $arq_options['data']['vimeo'] )  ){
		$result = $arq_options['data']['vimeo'];
	}
	else{
		$id = $arq_options['social']['vimeo']['id'];
		try {		
			$data 	= @arq_remote_get( "http://vimeo.com/api/v2/channel/$id/info.json" );
			$result = (int) $data['total_subscribers'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['vimeo'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['vimeo'] ) ) //Get the stored data
			$result = $arq_options['data']['vimeo'];	
	}
	return $result;
}

/* Dribbble Followers */
function arq_dribbble_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['dribbble']) ){
		$result = $arq_transient['dribbble'];
	}
	elseif( empty($arq_transient['dribbble']) && !empty($arq_data) && !empty( $arq_options['data']['dribbble'] )  ){
		$result = $arq_options['data']['dribbble'];
	}else{
		$id 	= $arq_options['social']['dribbble']['id'];
		$api 	= $arq_options['social']['dribbble']['api'];
		try {		
			$data 	= @arq_remote_get("https://api.dribbble.com/v1/users/$id?access_token=$api");
			$result = (int) $data['followers_count'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['dribbble'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['dribbble'] ) ) //Get the stored data
			$result = $arq_options['data']['dribbble'];	
	}
	return $result;
}

/* Github Followers */
function arq_github_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['github']) ){
		$result = $arq_transient['github'];
	}
	elseif( empty($arq_transient['github']) && !empty($arq_data) && !empty( $arq_options['data']['github'] )  ){
		$result = $arq_options['data']['github'];
	}
	else{
		$id = $arq_options['social']['github']['id'];
		try {		
			$data 	= @arq_remote_get("https://api.github.com/users/$id");
			$result = (int) $data['followers'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['github'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['github'] ) ) //Get the stored data
			$result = $arq_options['data']['github'];	
	}
	return $result;
}

/* Envato Followers */
function arq_envato_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['envato']) ){
		$result = $arq_transient['envato'];
	}
	elseif( empty($arq_transient['envato']) && !empty($arq_data) && !empty( $arq_options['data']['envato'] )  ){
		$result = $arq_options['data']['envato'];
	}
	else{
		$id = $arq_options['social']['envato']['id'];
		try {		
			$data 	= @arq_remote_get("http://marketplace.envato.com/api/edge/user:$id.json");
			$result = (int) $data['user']['followers'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['envato'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['envato'] ) ) //Get the stored data
			$result = $arq_options['data']['envato'];	
	}
	return $result;
}

/* SoundCloud Followers */
function arq_soundcloud_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['soundcloud']) ){
		$result = $arq_transient['soundcloud'];
	}
	elseif( empty($arq_transient['soundcloud']) && !empty($arq_data) && !empty( $arq_options['data']['soundcloud'] )  ){
		$result = $arq_options['data']['soundcloud'];
	}
	else{
		$id 	= $arq_options['social']['soundcloud']['id'];
		$api 	= $arq_options['social']['soundcloud']['api'];
		try {		
			$data 	= @arq_remote_get("http://api.soundcloud.com/users/$id.json?consumer_key=$api");
			$result = (int) $data['followers_count'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['soundcloud'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['soundcloud'] ) ) //Get the stored data
			$result = $arq_options['data']['soundcloud'];	
	}
	return $result;
}

/* Behance Followers */
function arq_behance_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['behance']) ){
		$result = $arq_transient['behance'];
	}
	elseif( empty($arq_transient['behance']) && !empty($arq_data) && !empty( $arq_options['data']['behance'] )  ){
		$result = $arq_options['data']['behance'];
	}
	else{
		$id 	= $arq_options['social']['behance']['id'];
		$api 	= $arq_options['social']['behance']['api'];
		try {		
			$data 	= @arq_remote_get("http://www.behance.net/v2/users/$id?api_key=$api");
			$result = (int) $data['user']['stats']['followers'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['behance'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['behance'] ) ) //Get the stored data
			$result = $arq_options['data']['behance'];	
	}
	return $result;
}

/* Delicious Followers */
function arq_delicious_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['delicious']) ){
		$result = $arq_transient['delicious'];
	}
	elseif( empty($arq_transient['delicious']) && !empty($arq_data) && !empty( $arq_options['data']['delicious'] )  ){
		$result = $arq_options['data']['delicious'];
	}
	else{
		$id = $arq_options['social']['delicious']['id'];
		try {		
			$data 	= @arq_remote_get("http://feeds.delicious.com/v2/json/userinfo/$id");
			$result = (int) $data[2]['n'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['delicious'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['delicious'] ) ) //Get the stored data
			$result = $arq_options['data']['delicious'];	
	}
	return $result;
}

/* Instagram Followers */
function arq_instagram_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['instagram']) ){
		$result = $arq_transient['instagram'];
	}
	elseif( empty($arq_transient['instagram']) && !empty($arq_data) && !empty( $arq_options['data']['instagram'] )  ){
		$result = $arq_options['data']['instagram'];
	}
	else{
		$api = get_option( 'instagram_access_token' );
		$id = explode(".", $api);
		try {		
			$data 	= @arq_remote_get("https://api.instagram.com/v1/users/$id[0]/?access_token=$api");
			$result = (int) $data['data']['counts']['followed_by'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['instagram'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['instagram'] ) ) //Get the stored data
			$result = $arq_options['data']['instagram'];	
	}
	return $result;
}

/* Foursquare Followers */
function arq_foursquare_count() {
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['foursquare']) ){
		$result = $arq_transient['foursquare'];
	}
	elseif( empty($arq_transient['foursquare']) && !empty($arq_data) && !empty( $arq_options['data']['foursquare'] )  ){
		$result = $arq_options['data']['foursquare'];
	}
	else{
		$api 	= get_option('foursquare_access_token');
		$date 	= date("Ymd");
		try {		
			$data 	= @arq_remote_get("https://api.foursquare.com/v2/users/self?oauth_token=$api&v=$date");
			$result = (int) $data['response']['user']['friends']['count'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['foursquare'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['foursquare'] ) ) //Get the stored data
			$result = $arq_options['data']['foursquare'];	
	}
	return $result;
}

/* Mailchimp Subscribers */
function arq_mailchimp_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['mailchimp']) ){
		$result = $arq_transient['mailchimp'];
	}
	elseif( empty($arq_transient['mailchimp']) && !empty($arq_data) && !empty( $arq_options['data']['mailchimp'] )  ){
		$result = $arq_options['data']['mailchimp'];
	}
	else{
		if (!class_exists('MCAPI')) require_once 'inc/mailchimp/MCAPI.class.php';

		$apikey = $arq_options['social']['mailchimp']['api'];
		$listId = $arq_options['social']['mailchimp']['id'];
		
		$api 	= new MCAPI($apikey);
		$retval = $api->lists();
		$result = 0;
		
		foreach ($retval['data'] as $list){
			if($list['id'] == $listId){
				$result = $list['stats']['member_count'];
				break;
			}
		}
			
		if( !empty( $result ) ) //To update the stored data
			$arq_data['mailchimp'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['mailchimp'] ) ) //Get the stored data
			$result = $arq_options['data']['mailchimp'];	
	}
	return $result;
}

/* MailPoet Subscribers */
function arq_mailpoet_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['mailpoet']) ){
		$result = $arq_transient['mailpoet'];
	}
	elseif( empty($arq_transient['mailpoet']) && !empty($arq_data) && !empty( $arq_options['data']['mailpoet'] )  ){
		$result = $arq_options['data']['mailpoet'];
	}
	else{

		$list = $arq_options['social']['mailpoet']['list'];
		
		if( !empty( $list )){
			if( $list == 'all' ){
				$result	= arqam_mailpoet_total_subscribers();
			}else{
				$result	= arqam_mailpoet_get_list_users( $list );
			}
		}
			
		if( !empty( $result ) ) //To update the stored data
			$arq_data['mailpoet'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['mailpoet'] ) ) //Get the stored data
			$result = $arq_options['data']['mailpoet'];	
	}
	return $result;
}

/* myMail Subscribers */
function arq_mymail_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['mymail']) ){
		$result = $arq_transient['mymail'];
	}
	elseif( empty($arq_transient['mymail']) && !empty($arq_data) && !empty( $arq_options['data']['mymail'] )  ){
		$result = $arq_options['data']['mymail'];
	}
	else{

		$list = $arq_options['social']['mymail']['list'];
		
		if( !empty( $list )){
			if( $list == 'all' ){
				$counts = mymail('subscribers')->get_count_by_status();
				$result	= $counts[1];
			}else{
				$result	= mymail('lists')->get_member_count( $list, 1) ;
			}
		}
			
		if( !empty( $result ) ) //To update the stored data
			$arq_data['mymail'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['mymail'] ) ) //Get the stored data
			$result = $arq_options['data']['mymail'];	
	}
	return $result;
}

/* LinkedIn Followers */
function arq_linkedin_count() {
	global $arq_data, $arq_options, $arq_transient;
	if( !empty($arq_transient['linkedin']) ){
		$result = $arq_transient['linkedin'];
	}
	elseif( empty($arq_transient['linkedin']) && !empty($arq_data) && !empty( $arq_options['data']['linkedin'] )  ){
		$result = $arq_options['data']['linkedin'];
	}
	else{
		$linkedin_id 	= $arq_options['social']['linkedin']['id'];
		$linkedin_group = $arq_options['social']['linkedin']['group'];

		if( !empty( $linkedin_id ) || !empty( $linkedin_group ) ){
			$linkedin_type = $arq_options['social']['linkedin']['type'];

			if( $linkedin_type == 'Group' ){
		
				try {
					$html = arq_remote_get( $linkedin_group , false);
					$doc = new DOMDocument();
					@$doc->loadHTML($html);
					$xpath = new DOMXPath($doc);

					$data = $xpath->evaluate('string(//span[@class="member-count"])' );
					if( empty( $data ) )
						$data = $xpath->evaluate('string(//a[@class="member-count"])');

					$result = (int) preg_replace('/[^0-9.]+/', '', $data);
				
				} catch (Exception $e) {
					$result = 0;
				}

			}else{

				try {
					$html 	= arq_remote_get( $linkedin_id , false);
					$doc 	= new DOMDocument();

					@$doc->loadHTML($html);

					$xpath 	= new DOMXPath($doc);
					$data 	= $xpath->evaluate('string(//p[@class="followers-count"])');
					$result = (int) preg_replace('/[^0-9.]+/', '', $data);
				
				} catch (Exception $e) {
					$result = 0;
				}
			}
			
			if( !empty( $result ) ) //To update the stored data
				$arq_data['linkedin'] = $result; 

			if( empty( $result ) && !empty( $arq_options['data']['linkedin'] ) ) //Get the stored data
				$result = $arq_options['data']['linkedin'];
		}
	}
	return $result;
}

/* Vk Members */
function arq_vk_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['vk']) ){
		$result = $arq_transient['vk'];
	}
	elseif( empty($arq_transient['vk']) && !empty($arq_data) && !empty( $arq_options['data']['vk'] )  ){
		$result = $arq_options['data']['vk'];
	}
	else{
		$id = $arq_options['social']['vk']['id'];
		try {		
			$data 	= @arq_remote_get( "http://api.vk.com/method/groups.getById?gid=$id&fields=members_count");
			$result = (int) $data['response'][0]['members_count'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['vk'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['vk'] ) ) //Get the stored data
			$result = $arq_options['data']['vk'];	
	}
	return $result;
}

/* Tumblr Followers */
function arq_tumblr_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['tumblr']) ){
		$result = $arq_transient['tumblr'];
	}
	elseif( empty($arq_transient['tumblr']) && !empty($arq_data) && !empty( $arq_options['data']['tumblr'] )  ){
		$result = $arq_options['data']['tumblr'];
	}
	else{
		$base_hostname = str_replace( array( 'http://','https://' ) , '', $arq_options['social']['tumblr']['hostname'] );
		
		try {
			$consumer_key		= get_option( 'tumblr_api_key' );
			$consumer_secret	= get_option( 'tumblr_api_secret' );
			$oauth_token		= get_option( 'tumblr_oauth_token' );
			$oauth_token_secret	= get_option( 'tumblr_token_secret' );
			$tumblr_api_URI		= 'http://api.tumblr.com/v2/blog/'.$base_hostname.'/followers';
			
			$tum_oauth 	= new TumblrOAuthTie($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
			$tumblr_api = $tum_oauth->post($tumblr_api_URI, '');
			
			if( $tumblr_api->meta->status == 200 && !empty($tumblr_api->response->total_users) )
				$result = (int) $tumblr_api->response->total_users ;	
			
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['tumblr'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['tumblr'] ) ) //Get the stored data
			$result = $arq_options['data']['tumblr'];	
	}
	return $result;
}

/* 500px Followers */
function arq_500px_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['500px']) ){
		$result = $arq_transient['500px'];
	}
	elseif( empty($arq_transient['500px']) && !empty($arq_data) && !empty( $arq_options['data']['500px'] )  ){
		$result = $arq_options['data']['500px'];
	}
	else{
		$px500_username = $arq_options['social']['500px']['username'];
		try {
			$consumer_key		= get_option( '500px_api_key' );
			$consumer_secret	= get_option( '500px_api_secret' );
			$oauth_token		= get_option( '500px_oauth_token' );
			$oauth_token_secret	= get_option( '500px_token_secret' );
			
			$px500_oauth		= new tie500pxOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
			$px500_api 			= $px500_oauth->get('users/show', array('username' => $px500_username ));
						
			if( !empty( $px500_api->user->followers_count ) )
				$result = (int) $px500_api->user->followers_count ;	
			
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['500px'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['500px'] ) ) //Get the stored data
			$result = $arq_options['data']['500px'];	
	}
	return $result;
}

/* Vine Followers */
function arq_vine_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['vine']) ){
		$result = $arq_transient['vine'];
	}
	elseif( empty($arq_transient['vine']) && !empty($arq_data) && !empty( $arq_options['data']['vine'] )  ){
		$result = $arq_options['data']['vine'];
	}
	else{
		try {
			$vine 	= new TieVine( $arq_options['social']['vine']['email'] , $arq_options['social']['vine']['pass'] );
			$result = $vine->me();			
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['vine'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['vine'] ) ) //Get the stored data
			$result = $arq_options['data']['vine'];	
	}
	return $result;
}

/* Pinterest Followers */
function arq_pinterest_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['pinterest']) ){
		$result = $arq_transient['pinterest'];
	}
	elseif( empty($arq_transient['pinterest']) && !empty($arq_data) && !empty( $arq_options['data']['pinterest'] )  ){
		$result = $arq_options['data']['pinterest'];
	}
	else{
		$username = $arq_options['social']['pinterest']['username'];
		try {
			$html 	= arq_remote_get( "https://www.pinterest.com/$username/" , false);
			$doc 	= new DOMDocument();
			@$doc->loadHTML($html);
			$metas 	= $doc->getElementsByTagName('meta');
			for ($i = 0; $i < $metas->length; $i++)
			{    $meta = $metas->item($i);
				if($meta->getAttribute('name') == 'pinterestapp:followers'){
					$result = $meta->getAttribute('content');
					break;
				}
			}
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['pinterest'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['pinterest'] ) ) //Get the stored data
			$result = $arq_options['data']['pinterest'];	
	}
	return $result;
}

/* Flickr Followers */
function arq_flickr_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['flickr']) ){
		$result = $arq_transient['flickr'];
	}
	elseif( empty($arq_transient['flickr']) && !empty($arq_data) && !empty( $arq_options['data']['flickr'] )  ){
		$result = $arq_options['data']['flickr'];
	}
	else{
		$id 	= $arq_options['social']['flickr']['id'];
		$api 	= $arq_options['social']['flickr']['api'];
		try {
			$data 	= @arq_remote_get( "https://api.flickr.com/services/rest/?method=flickr.groups.getInfo&api_key=$api&group_id=$id&format=json&nojsoncallback=1");
			$result = (int) $data['group']['members']['_content'];	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['flickr'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['flickr'] ) ) //Get the stored data
			$result = $arq_options['data']['flickr'];	
	}
	return $result;
}

/* Steam Followers */
function arq_steam_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['steam']) ){
		$result = $arq_transient['steam'];
	}
	elseif( empty($arq_transient['steam']) && !empty($arq_data) && !empty( $arq_options['data']['steam'] )  ){
		$result = $arq_options['data']['steam'];
	}
	else{
		$id = $arq_options['social']['steam']['group'];
		try {
			$data 	= @arq_remote_get( "http://steamcommunity.com/groups/$id/memberslistxml?xml=1" , false );
			$data 	= @new SimpleXmlElement( $data );			
			$result = (int) $data->groupDetails->memberCount;	
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['steam'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['steam'] ) ) //Get the stored data
			$result = $arq_options['data']['steam'];	
	}
	return $result;
}

/* Rss Subscribers */
function arq_rss_count() {
	global $arq_data, $arq_options, $arq_transient;
		
	if( !empty($arq_transient['rss']) ){
		$result = $arq_transient['rss'];
	}
	elseif( empty($arq_transient['rss']) && !empty($arq_data) && !empty( $arq_options['data']['rss'] )  ){
		$result = $arq_options['data']['rss'];
	}
	else{
		if( ( $arq_options['social']['rss']['type'] == 'feedpress.it' ) && !empty($arq_options['social']['rss']['feedpress']) ){
			try {
				$feedpress_url 	= esc_url($arq_options['social']['rss']['feedpress']);
				$feedpress_url 	= str_replace( 'feedpress.it', 'feed.press', $feedpress_url);
				$feedpress_url 	= str_replace( 'http', 'https', $feedpress_url);
				$data 			= @arq_remote_get( $feedpress_url );
				$result 		= (int) $data[ 'subscribers' ];	
			} catch (Exception $e) {
				$result = 0;
			}
		}
		elseif( ( $arq_options['social']['rss']['type'] == 'Manual' ) && !empty($arq_options['social']['rss']['manual']) ){
			$result = $arq_options['social']['rss']['manual'] ;
		}
		else{
			$result = 0;
		}
		if( !empty( $result ) ) //To update the stored data
			$arq_data['rss'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['rss'] ) ) //Get the stored data
			$result = $arq_options['data']['rss'];	
	}
	return $result;
}

/* Spotify Followers */
function arq_spotify_count(){
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['spotify']) ){
		$result = $arq_transient['spotify'];
	}
	elseif( empty($arq_transient['spotify']) && !empty($arq_data) && !empty( $arq_options['data']['spotify'] )  ){
		$result = $arq_options['data']['spotify'];
	}
	else{
		$id = $url = $arq_options['social']['spotify']['id'];
		$id = rtrim( $id , "/");
		$id = urlencode( str_replace( array(  'https://play.spotify.com/', 'https://player.spotify.com/', 'artist/', 'user/' ) , '', $id) );

		try {		
			if( !empty( $url ) && strpos( $url, 'artist') !== false ){
				$data = @arq_remote_get("https://api.spotify.com/v1/artists/$id");
			}else{
				$data = @arq_remote_get("https://api.spotify.com/v1/users/$id");
			}
			$result = (int) $data['followers']['total'];	

		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['spotify'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['spotify'] ) ) //Get the stored data
			$result = $arq_options['data']['spotify'];	
	}
	return $result;	
}

/* Goodreads Followers */
function arq_goodreads_count(){
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['goodreads']) ){
		$result = $arq_transient['goodreads'];
	}
	elseif( empty($arq_transient['goodreads']) && !empty($arq_data) && !empty( $arq_options['data']['goodreads'] )  ){
		$result = $arq_options['data']['goodreads'];
	}
	else{
		$id  = $url = $arq_options['social']['goodreads']['id'];
		$key = $arq_options['social']['goodreads']['key'];

		$id = rtrim( $id , "/");
		$id = @parse_url($id);
		$id = $id['path'];
		$id = str_replace( array( '/user/show/', '/author/show/' ) , '', $id);
		if( strpos( $id, '-') !== false ){
			$id = explode( '-', $id);
		}else{
			$id = explode( '.', $id);
		}
		$id = $id[0];
		try {		
			if( !empty( $url ) && strpos( $url, 'author') !== false ){
				$data 	= @arq_remote_get("https://www.goodreads.com/author/show/$id.xml?key=$key", false);
				$data 	= @new SimpleXmlElement( $data );
				$result = (int) $data->author->author_followers_count;
			}else{
				$data 	= @arq_remote_get("https://www.goodreads.com/user/show/$id.xml?key=$key", false);
				$data 	= @new SimpleXmlElement( $data );	
				$result = (int) $data->user->friends_count;
			}

		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['goodreads'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['goodreads'] ) ) //Get the stored data
			$result = $arq_options['data']['goodreads'];	
	}
	return $result;	
}

/* Twitch Followers */
function arq_twitch_count(){
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['twitch']) ){
		$result = $arq_transient['twitch'];
	}
	elseif( empty($arq_transient['twitch']) && !empty($arq_data) && !empty( $arq_options['data']['twitch'] )  ){
		$result = $arq_options['data']['twitch'];
	}
	else{
		$id  = $arq_options['social']['twitch']['id'];

		try {		
			$data 	= @arq_remote_get("https://api.twitch.tv/kraken/channels/$id");
			$result = (int) $data['followers'];
		} catch (Exception $e) {
			$result = 0;
		}
		
		if( !empty( $result ) ) //To update the stored data
			$arq_data['twitch'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['twitch'] ) ) //Get the stored data
			$result = $arq_options['data']['twitch'];	
	}
	return $result;	
}

/* Mixcloud Followers */
function arq_mixcloud_count(){
	global $arq_data, $arq_options, $arq_transient;

	if( !empty($arq_transient['mixcloud']) ){
		$result = $arq_transient['mixcloud'];
	}
	elseif( empty($arq_transient['mixcloud']) && !empty($arq_data) && !empty( $arq_options['data']['mixcloud'] )  ){
		$result = $arq_options['data']['mixcloud'];
	}
	else{
		$id  = $arq_options['social']['mixcloud']['id'];
		try {		
			$data 	= @arq_remote_get("http://api.mixcloud.com/$id/");
			$result = (int) $data['follower_count'];
		} catch (Exception $e) {
			$result = 0;
		}

		if( !empty( $result ) ) //To update the stored data
			$arq_data['mixcloud'] = $result; 

		if( empty( $result ) && !empty( $arq_options['data']['mixcloud'] ) ) //Get the stored data
			$result = $arq_options['data']['mixcloud'];	
	}
	return $result;	
}

/* Posts Number */
function arq_posts_count() {
	$count_posts 	= wp_count_posts();
	return $result 	= $count_posts->publish ;
}

/* Comments number */
function arq_comments_count() {
	$comments_count = wp_count_comments() ;
	return $result  = $comments_count->approved ;
}

/* Members number */
function arq_members_count() {
	$members_count  = count_users() ;
	return $result  = $members_count['total_users'] ;
}

/* Groups number */
function arq_groups_count() {
	return $result = groups_get_total_group_count();
}

/* bbPress Counters */
function arq_bbpress_count( $count ) {
	$arg = array (
		'count_users'           => false,
		'count_forums'          => false,
		'count_topics'          => false,
		'count_private_topics'  => false,
		'count_spammed_topics'  => false,
		'count_trashed_topics'  => false,
		'count_replies'         => false,
		'count_private_replies' => false,
		'count_spammed_replies' => false,
		'count_trashed_replies' => false,
		'count_tags'            => false,
		'count_empty_tags'      => false
	);
	$arg[ 'count_' . $count ]	= true; 

	$counters = bbp_get_statistics( $arg );
	if( $count == 'forums' ){
		$result = $counters[ 'forum_count' ];
	}
	elseif( $count == 'topics' ){
		$result = $counters[ 'topic_count' ];
	}
	elseif( $count == 'replies' ){
		$result = $counters[ 'reply_count' ];
	}
	return $result;
}

/*-----------------------------------------------------------------------------------*/
# Social Counter Widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'arqam_counter_widget_box' );
function arqam_counter_widget_box() {
	register_widget( 'arqam_counter_widget' );
}
class arqam_counter_widget extends WP_Widget {

	function arqam_counter_widget() {
		$widget_ops 	= array( 'classname' => 'arqam_counter-widget', 'description' => ''  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'arqam_counter-widget' );
		parent::__construct( 'arqam_counter-widget', ARQAM_Plugin. ' - ' . __( 'Social Counter' ), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {

		extract( $args );

		$title 		= $instance['title'] ;
		$layout 	= $instance['layout'] ;
		$columns 	= $instance['columns'] ;
		$dark 		= $instance['dark'] ;
		$width 		= $instance['width'] ;
		$box_only 	= $instance['box_only'] ;

		$inside_widget = false;

		if( empty($box_only) ){
			echo $before_widget . $before_title . $title . $after_title;
			$inside_widget = true;
		}

		arq_get_counters( $layout, $columns, $dark, $width, '', $inside_widget );
		
		if( empty($box_only) ){
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['layout'] 	= $new_instance['layout'] ;
		$instance['columns'] 	= $new_instance['columns'] ;
		$instance['title'] 		= $new_instance['title'] ;
		$instance['dark'] 		= $new_instance['dark'] ;
		$instance['width'] 		= $new_instance['width'] ;
		$instance['box_only'] 	= $new_instance['box_only'] ;

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __( 'Follow us' , 'arq' )  , 'layout' => 'flat' ,'columns' => '3' , 'dark' => false, 'box_only' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title :' , 'arq' ) ?> </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e( 'Style :' , 'arq' ) ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" >
				<option value="metro" <?php if( $instance['layout'] == 'metro' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Metro Style' , 'arq' ) ?></option>
				<option value="gray" <?php if( $instance['layout'] == 'gray' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Gray Icons' , 'arq' ) ?></option>
				<option value="colored" <?php if( $instance['layout'] == 'colored' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Colored Icons' , 'arq' ) ?></option>
				<option value="colored_border" <?php if( $instance['layout'] == 'colored_border' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Colored Border Icons' , 'arq' ) ?></option>				
				<option value="flat" <?php if( $instance['layout'] == 'flat' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( 'Flat Icons' , 'arq' )?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Columns :' , 'arq' ) ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" >

				<option value="1" <?php if( $instance['columns'] == '1' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( '1 Column'  , 'arq' ) ?></option>
				<option value="2" <?php if( $instance['columns'] == '2' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( '2 Columns' , 'arq' ) ?></option>
				<option value="3" <?php if( $instance['columns'] == '3' ) echo "selected=\"selected\""; else echo ""; ?>><?php _e( '3 Columns' , 'arq' ) ?></option>
			</select>
			<small> <?php _e( 'Columns option not available for the METRO style.', 'arq' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dark' ); ?>"><?php _e( 'Dark Skin :' , 'arq' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'dark' ); ?>" name="<?php echo $this->get_field_name( 'dark' ); ?>" value="true" <?php if( $instance['dark'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'box_only' ); ?>"><?php _e( 'Show the Social Box only :' , 'arq' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'box_only' ); ?>" name="<?php echo $this->get_field_name( 'box_only' ); ?>" value="true" <?php if( $instance['box_only'] ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small><?php _e( 'Will avoid the theme widget design and hide the widget title .' , 'arq' ) ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Forced Items Width :' , 'arq' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php if(isset( $instance['width'] )) echo $instance['width']; ?>" style="width:40px;" type="text" />
		</p>
		
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
# Tie Wp Head
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'tie_arqam_css');
function tie_arqam_css() {
	global $arq_options, $arq_social_items ;
	
	if( !empty( $arq_options['css'] ) || !empty( $arq_options['color'] ) ){ ?>
<style type="text/css" media="screen"> 
<?php
		 $css_code =  str_replace("<pre>", "", htmlspecialchars_decode( $arq_options['css'] ) ); 
	echo $css_code = str_replace("</pre>", "", $css_code )  , "\n";

 	foreach( $arq_social_items as $item ){

 		if( !empty( $arq_options['color'][$item] ) ){
 			if( $item == '500px' ){
 				$arq_options['color']['fivehundredpx'] = $arq_options['color'][$item];
 				$item = 'fivehundredpx';
 			}
?>
	.arqam-widget-counter.arq-colored li.arq-<?php echo $item ?> a i,
	.arqam-widget-counter.arq-flat li.arq-<?php echo $item ?> a,
	.arqam-widget-counter.arq-outer-frame.arq-border-colored li.arq-<?php echo $item ?>:hover a i{
		background-color:<?php echo $arq_options['color'][$item] ?> !important;
	}
	.arqam-widget-counter.arq-outer-frame.arq-border-colored li.arq-<?php echo $item ?> a i{
		border-color:<?php echo $arq_options['color'][$item] ?>;
		color: <?php echo $arq_options['color'][$item] ?>;
	}
<?php
		}
	}
?>
</style> 
<?php
	}
}

/*-----------------------------------------------------------------------------------*/
# Plugin DB Update
/*-----------------------------------------------------------------------------------*/
if( get_option('arqam_active') && get_option('arqam_active') < '1.7.0' ){
	global $arq_options;

	if( !empty( $arq_options['social']['instagram']['api'] ) && !get_option( 'instagram_access_token' ) ){
		update_option( 'instagram_access_token',  $arq_options['social']['instagram']['api'] );
		unset( $arq_options['social']['instagram']['api'] );
	}

	if( !empty( $arq_options['social']['foursquare']['api'] ) && !get_option( 'foursquare_access_token' ) ){
		update_option( 'foursquare_access_token',  $arq_options['social']['foursquare']['api'] );
		unset( $arq_options['social']['foursquare']['api'] );
	}

	if( !empty( $arq_options['social']['linkedin']['id'] ) ){
		$arq_options['social']['linkedin']['id'] = 'https://www.linkedin.com/company/'.$arq_options['social']['linkedin']['id'];
	}

	if( !empty( $arq_options['social']['linkedin']['group'] ) ){
		$arq_options['social']['linkedin']['group'] = 'https://www.linkedin.com/groups/'.$arq_options['social']['linkedin']['group'];
	}

	update_option( 'arq_options' , $arq_options);
	update_option( 'arqam_active' , '1.7.0' );

} elseif( get_option('arqam_active') && get_option('arqam_active') < '2.0.0' ){
	global $arq_options;
	
	$sort 		= $arq_options[ 'sort' ];
	if( !empty( $sort ) && is_array( $sort ) ){
		$google 	= array_search('google+', $sort);
		$forrst 	= array_search('forrst',  $sort);

		$arq_options['sort'][ $google ] = 'google';

		unset( $arq_options['sort'][ $forrst ] );

		if( $arq_options['sort'][ $google ] == 'google' && !isset( $arq_options['sort'][ $forrst ] ) ){
			$update_sort_array = update_option( 'arq_options', $arq_options);
		}
	}

	update_option( 'arqam_active' , '2.0.0' );
}
?>