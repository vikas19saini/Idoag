<?php

class C5AB_social_count extends C5_Widget {

    public $_shortcode_name;
    public $_shortcode_bool = true;
    public $_options = array();

    function __construct() {

        $id_base = 'social_count-widget';
        $this->_shortcode_name = 'c5ab_social_count';
        $name = 'Social Followers Count';
        $desc = 'Social Followers Counter.';
        $classes = '';

        $this->self_construct($name, $id_base, $desc, $classes);
    }

    function custom_number_format($n) {

        $precision = 1;

        if ($n < 1000) {
            $n_format = round($n);
        } else if ($n < 1000000) {
            $n_format = round($n / 1000, $precision) . 'K';
        } else {
            $n_format = round($n / 1000000, $precision) . 'M';
        }

        return $n_format;
    }

    function shortcode($atts, $content) {

        $data = '';
		
		$all_data = c5_get_arqam_data();
		
		if (!empty($all_data)) {
			$data .= '<div class="c5ab_social_counter clearfix" ><ul>';
			foreach ($all_data as $social_network => $social_network_data) {
				$data .= '<li><a href="'.$social_network_data['url'].'" class="c-'.$social_network.'" target="_blank"><span class="icon">'.$social_network_data['icon'].'</span><span class="count">' . $this->custom_number_format($social_network_data['count']) . '</span></a></li>';
			}
			$data .= '</ul></div>';
		}
		

        
        return $data;
    }

    function custom_css() {
        
    }

    function options() {




        $this->_options = array(
            array(
                'label' => 'Twitter username',
                'id' => 'twitter',
                'type' => 'text',
                'desc' => 'Add your social_count username.',
                'std' => '',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => ''
            ),
            array(
                'label' => 'Facebook username',
                'id' => 'facebook',
                'type' => 'text',
                'desc' => 'Add your Facebook username.',
                'std' => '',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => ''
            ),
            array(
                'label' => 'Google Plus username',
                'id' => 'google_plus',
                'type' => 'text',
                'desc' => 'Add your Google Plus username.',
                'std' => '',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => ''
            ),
            array(
                'label' => 'Youtube username',
                'id' => 'youtube',
                'type' => 'text',
                'desc' => 'Add your Youtube username.',
                'std' => '',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'class' => ''
            ),
        );
    }

    
}
?>