<?php 

class C5AB_featured_post extends C5_Widget {


	public  $_shortcode_name;
	public  $_shortcode_bool = true;
	public  $_options =array();
	public  $_skip_title = true;
	
	function __construct() {
		
		$id_base = 'featured_post-widget';
		$this->_shortcode_name = 'c5ab_featured_post';
		$name = 'Featured Post';
		$desc = 'Featured Post';
		$classes = '';
		
		$this->self_construct($name, $id_base , $desc , $classes);
		
		
	}
	
	
	function shortcode($atts,$content) {
		
			$post_type = get_post_type($atts['post_id']);
		    $args  =array();
		    if ($atts['post_id'] == '') {
		    	return '';
		    }
		    $args['post_type'] = 'any';
		    $args['post__in'] = explode(',', $atts['post_id']);
		    $args['orderby'] = 'post__in';
		   
		    // The Query
		    $the_query = new WP_Query( $args );
		    $return = '';
		    
		    // The Loop
		    if ( $the_query->have_posts() ) {
		    	$code = '[c5ab_title title="' . $atts['featured_post'] . '"  icon="' . $atts['icon'] . '"]';
		    	 $return .= do_shortcode($code);
		          
		         while ( $the_query->have_posts() ) {
		    		$the_query->the_post();
		    		
		    		
    		        $class = '';
    				$post_obj = new C5_post();
    		        
    		        $width = $GLOBALS['c5_content_width'];
    		        $GLOBALS['c5_content_width'] = 300;
    		       	$return .= $post_obj->get_menu_post();
		    		$GLOBALS['c5_content_width'] = $width;
		    	 }
		   	}
		   	/* Restore original Post Data */
		   	wp_reset_postdata();
		    return $return;
		
	}
	
	
	function custom_css() {
		
	}
	
	function options() {
		$obj = new C5AB_ICONS();
		$icons = $obj->get_icons_as_images();
		
		
		
		
		
		$this->_options =array(
			
			array(
			    'label' => 'Title',
			    'id' => 'featured_post',
			    'type' => 'text',
			    'desc' => 'Title.',
			    'std' => '',
			    'rows' => '',
			    'post_type' => '',
			    'taxonomy' => '',
			    'class' => ''
			),
			array(
			  'label'       => 'Icon',
			  'id'          => 'icon',
			  'type'        => 'radio-text',
			  'desc'        => '',
			  'choices' => $icons,
			  'std'         => 'fa fa-none',
			  'rows'        => '',
			  'post_type'   => '',
			  'taxonomy'    => '',
			  'class'       => 'c5ab_icons'
			),
			array(
			    'label' => 'Add Articles',
			    'id' => 'post_id',
			    'type' => 'posts-search',
			    'desc' => '',
			    'std' => '',
			    'rows' => '',
			    'post_type' => '',
			    'taxonomy' => '',
			    'class' => ''
			),
				 
		);
	}
	
	function admin_footer_js() {
			?>
			<script  type="text/javascript" id="c5_posts_apperance">
				jQuery(document).ready(function($) {
				   
				    C5AB_POSTS_SELECT_JS.init();
	
				});
	
			</script>
			<?php
		}
	
	

}


 ?>