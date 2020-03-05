<?php
add_filter('c5ab_theme_mode', '__return_true');
/*
if(isset($_GET['c5_flip'])){
	$simple_option = get_option('c5_options_mode');
	if($simple_option == 'simple'){
		update_option('c5_options_mode', 'advanced');
	}else {
		update_option('c5_options_mode', 'simple');
	}
}

$simple_option = get_option('c5_options_mode');

if($simple_option == 'advanced'){
	define('C5_simple_option', false);	
}else {
	define('C5_simple_option', true);
}
*/
define('C5_simple_option', true);
$GLOBALS['c5-in-article'] =false;

define('C5_development_mode', false);



define('C5_ROOT', get_template_directory() . '/');
define('C5_URL', get_template_directory_uri() . '/');

if ( ! isset( $content_width ) ) $content_width = 740;

if (C5_development_mode) {
	require_once(C5_ROOT . 'library/includes/wp-less.php' );	
}


require_once(C5_ROOT . 'library/bones.php' ); 
require_once(C5_ROOT . 'library/includes/awesome-builder/loader.php' );
require_once(C5_ROOT . 'library/includes/loader.php' );
require_once(C5_ROOT . 'library/includes/widget-import-export/widget-data.php' );
require_once(C5_ROOT . 'library/includes/import/loader.php' );
require_once(C5_ROOT . 'library/includes/tgm/arqam.php' );
require_once(C5_ROOT . 'library/includes/arqam-functions.php' );
require_once(C5_ROOT . 'library/translation/translation.php' );





add_image_size( 'thumbnail', 150, 150, true );
add_image_size( 'medium', 300, 300, true );


function c5_import_admin_notice() {
    ?>
    	<input type="hidden" name="website_dir" id="website_dir" value="<?php echo esc_url(home_url()); ?>" />
    	<style>
    		#option-tree-settings-api .ui-tabs,
    		.ot-metabox-wrapper{
    			direction: ltr;
    		}
    		
    		#wp-admin-bar-c5_install_demo{
    			cursor: pointer;
    		}
    		.mfp-install-demo-post.mfp-auto-cursor  .mfp-content{
    			max-width:500px;
    			background: white;
    			padding: 30px;
    		}
    		
    		.btn {
    		display: inline-block;
    		padding: 8px 12px;
    		margin-bottom: 0;
    		font-size: 14px;
    		font-weight: 500;
    		line-height: 1.428571429;
    		text-align: center;
    		white-space: nowrap;
    		vertical-align: middle;
    		cursor: pointer;
    		border: 1px solid transparent;
    		border-radius: 4px;
    		}
    		a.btn{
    			text-decoration:none;
    		}
    		
    		.btn-primary {
    		color: #fff;
    		background-color: #428bca;
    		border-color: #428bca;
    		}
    		
    		.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active {
    		background-color: #357ebd;
    		border-color: #3071a9;
    		}
    		
    		.btn:hover, .btn:focus {
    		color: #fff;
    		text-decoration: none;
    		}
    	</style>
    <?php
}
add_action( 'admin_notices', 'c5_import_admin_notice' );

function c5_import_admin_js($hook) {
   
	wp_enqueue_style( 'c5ab-flexslider', C5BP_extra_uri . 'css/flexslider.css');
	wp_enqueue_script( 'c5ab-flexslider', C5BP_extra_uri . 'js/jquery.flexslider-min-2-5.js', array(), '2.5', true );
      
   wp_enqueue_style( 'c5-admin-ss', get_template_directory_uri() . '/library/css/admin.css' );
   wp_register_script( 'admin-import-js', get_template_directory_uri() . '/library/js/js-admin.js', array( 'jquery' ), '', true );
   wp_enqueue_script( 'admin-import-js' );
}
add_action( 'admin_enqueue_scripts', 'c5_import_admin_js' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function c5_register_sidebars() {
	$all_sidebars = array(
		array(
			'id'=>'sidebar',
			'name'=>'Primary Sidebar',
			'description' => 'Default Sidebar for All Pages'
		),
		array(
			'id'=>'article',
			'name'=>'Article Sidebar',
			'description' => 'Default Sidebar for Articles'
		),
	);
	if(class_exists( 'WooCommerce' )){
		$all_sidebars[] =  array(
			'id'=>'shop_sidebar',
			'name'=>'Shop Sidebar',
			'description' => 'Shop Sidebar'
		);
	}
	
	
	$sidebars = ot_get_option('sidebars', array());
	if ($sidebars) {
	    foreach ($sidebars as $sidebar) {
	    	$all_sidebars[] = array(
	    		'id'=>$sidebar['slug'],
	    		'name'=>$sidebar['title'],
	    		'description' => $sidebar['description']
	    	);
	    }
	}
	
	foreach ($all_sidebars as  $sidebar) {
		register_sidebar(array(
			'id' => $sidebar['id'],
			'name' => $sidebar['name'],
			'description' => $sidebar['description'],
			'before_widget' => '<div id="%1$s" class="widget c5_al_widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		));
	}
	
	
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function c5_comments( $comment, $args, $depth ) {
	?>
   <li <?php comment_class(); ?>>
   	<article id="comment-<?php comment_ID(); ?>" class="clearfix">
   		<header class="comment-author vcard clearfix">
   		    <?php /*
   		        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
   		        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
   		    */ ?>
   		    <!-- custom gravatar call -->
   		    <?php echo get_avatar($comment,$size='64',$default= ot_get_option('avatar') ); ?>
   		    <!-- end custom gravatar call -->
   			<?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?><br><time class="time_class" datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
   			<?php edit_comment_link(__('(Edit)', 'code125'),'  ','') ?>
   			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
   		</header>
   		<?php if ($comment->comment_approved == '0') : ?>
      			<div class="alert info">
         			<p><?php _e('Your comment is awaiting moderation.', 'code125') ?></p>
         		</div>
   		<?php endif; ?>
   		<section class="comment_content clearfix">
   			<?php comment_text() ?>
   		</section>
   		
   	</article>
   <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

function c5_wp_title( $title, $sep ) {
	global $paged, $page;
	$sep = '|';
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title = get_bloginfo( 'name' ) . ' ' . $sep;
	
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description' );
	if (  is_home() || is_front_page()  ){
		$title .= ' ' . $site_description;
		
	}else {
		$title .= ' ' . get_the_title();
	}
	
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title .= " " . sprintf( __( 'Page %s', 'code125' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'c5_wp_title', 0, 2 );


add_action('wp_footer','c5_wp_footer_time',99999);

function c5_wp_footer_time() {
	 
	$diff = microtime(true) - $GLOBALS['c5_page_load_start' ];
	 ?>
	<!-- this page took <?php echo $diff ?> Seconds to load, Caution if you are using a caching plugin so this won't be an actual data - generated by Crystal WordPress Theme-->
	<?php
}

add_action( 'save_post',  'c5ab_catssave_meta_box'  , 1, 2 );
function c5ab_catssave_meta_box( $post_id, $post_object) {
	 global $pagenow;
	       
      /* don't save if $_POST is empty */
      if ( empty( $_POST ) )
        return $post_id;
      
      /* don't save during quick edit */
      if ( $pagenow == 'admin-ajax.php' )
        return $post_id;
        
      /* don't save during autosave */
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

      /* don't save if viewing a revision */
      if ( $post_object->post_type == 'revision' || $pagenow == 'revision.php' )
        return $post_id;
        
      if(isset( $_POST['category_styling']) ){
      	update_post_meta($post_id, 'category_styling' , $_POST['category_styling']);
      }
	        
	        
}

function c5_get_tax_from_post_type($post_type) {
	$obj = get_post_type_object( $post_type);
	foreach ($obj->taxonomies as  $taxonomy) {
		if($taxonomy!='post_tag'){
			return $taxonomy;
		}
	}
	return false;
	
}


function c5_imageCreateFromAny($filepath) { 
	
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
    $allowedTypes = array( 
        1,  // [] gif 
        2,  // [] jpg 
        3,  // [] png 
        6   // [] bmp 
    ); 
    if (!in_array($type, $allowedTypes)) { 
        return false; 
    } 
    switch ($type) { 
        case 1 : 
            $im = imageCreateFromGif($filepath); 
        break; 
        case 2 : 
            $im = imageCreateFromJpeg($filepath); 
        break; 
        case 3 : 
            $im = imageCreateFromPng($filepath); 
        break; 
        case 6 : 
            $im = imageCreateFromBmp($filepath); 
        break; 
    }    
    return $im;  
} 

// get average luminance, by sampling $num_samples times in both x,y directions
    function c5_get_avg_luminance($filename, $num_samples=10) {
    	if (!function_exists('exif_imagetype')) {
    		return 0;
    	}
    	$options = get_option('c5_images_luminance');
    	if (is_array($options)) {
    		if (isset($options[$filename])) {
    			return $options[$filename];
    		}
    	}else {
    		$options =array();
    	}
    	
    	
        $img = c5_imageCreateFromAny($filename);

        $width = imagesx($img);
        $height = imagesy($img);

        $x_step = intval($width/$num_samples);
        $y_step = intval($height/$num_samples);

        $total_lum = 0;

        $sample_no = 1;

        for ($x=0; $x<$width; $x+=$x_step) {
            for ($y=0; $y<$height; $y+=$y_step) {

                $rgb = imagecolorat($img, $x, $y);
                $lum = c5_get_lum($rgb);

                $total_lum += $lum;

                // debugging code
     //           echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
                $sample_no++;
            }
        }

        // work out the average
        $avg_lum  = round( $total_lum/$sample_no);
		
		
		$options[$filename] = $avg_lum;
		update_option('c5_images_luminance' , $options);
        return  $avg_lum;
    }
    function c5_get_lum_hex($color) {
    	$hex = str_replace('#', '', $color);
    	
    	if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
    	$lum = round( ($r+$r+$b+$g+$g+$g)/6 );
    	return $lum;
    }
    function c5_get_lum($color) {
    	// choose a simple luminance formula from here
    	// http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
    	$r = ($color >> 16) & 0xFF;
        $g = ($color >> 8) & 0xFF;
        $b = $color & 0xFF;

        // choose a simple luminance formula from here
        // http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
        $lum = round( ($r+$r+$b+$g+$g+$g)/6 );
        return $lum;
    }




?>
