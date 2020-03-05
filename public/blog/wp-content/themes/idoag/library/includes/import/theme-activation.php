<?php

class C5_theme_activation {

    public $_sections = array();
    public $_options = array();
    public $_theme_name = 'Crystal';

    function __construct() {
        
    }

    function hook() {

        add_action('admin_menu', array($this, 'hook_page'));
        add_action('admin_init', array($this, 'admin_init'));
    }

    function admin_init() {
        if (isset($_GET['demo_type'])) {

            global $wpdb;

            if (!defined('WP_LOAD_IMPORTERS'))
                define('WP_LOAD_IMPORTERS', true);

            // Load Importer API
            require_once ABSPATH . 'wp-admin/includes/import.php';

            if (!class_exists('WP_Importer')) {
                $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                if (file_exists($class_wp_importer)) {
                    require $class_wp_importer;
                }
            }

            if (!class_exists('WP_Import')) {
                $class_wp_importer = get_template_directory() . "/library/includes/import/wordpress-importer/wordpress-importer.php";
                if (file_exists($class_wp_importer))
                    require $class_wp_importer;
            }
        }
    }

    function install_html() {
        if (isset($_GET['demo_type'])) {

            $type = $_GET['demo_type'];
            $id = $_GET['demo_id'];


//			$obj = new C5_theme_activation();

            $all_objects = $this->all_demos();

            $info = $all_objects[$id];

            echo '<pre>';
            if ($type == 'demo' || $type == 'options') {
                $this->import_theme_options($info['theme-options']);

                c5_register_sidebars();
            }


            if ($type == 'demo' || $type == 'widget') {
                $this->update_sidebars($info['widgets']);
            }

            if (class_exists('WP_Import') && $type == 'demo') {
                $import_filepath = $info['xml'];
                $wp_import = new WP_Import();
                $wp_import->fetch_attachments = true;
                $wp_import->import($import_filepath);

                $this->update_categories_ids();
                $this->update_categories_colors();

                $obj = new C5_header_css();
                $obj->create_terms_array();


                $nav_menu_locations = array(
                    'main-nav' => 'Main Menu',
                );


                set_theme_mod('nav_menu_locations', $nav_menu_locations);

                $home = get_page_by_title($info['homepage']);
                update_option('page_on_front', $home->ID);
                update_option('show_on_front', 'page');


                $demo_url = 'code125.com';

                $old_settings = get_option('option_tree');

                $old_settings['preview'] = 'off';

                foreach ($old_settings as $key => $value) {
                    if (is_array($value)) {
                        continue;
                    }

                    if (strpos($value, $demo_url) && !strpos($value, 'files.' . $demo_url)) {
                        $info = explode('/', $value);
                        $index = count($info) - 1;
                        $new_value = $this->get_attachment_id_from_filename($info[$index]);
                        if ($new_value != '') {
                            $old_settings[$key] = $new_value;
                        }
                    }
                }


                update_option('option_tree', $old_settings);
            }
            echo '</pre>';
        }
    }

    function hook_page() {

        add_submenu_page('tools.php', $this->_theme_name . ' Import', $this->_theme_name . ' Import', 'edit_pages', 'c5-demo-import', array($this, 'import_page'));
    }

    function all_demos() {
        $base_url = 'http://files.code125.com/crystal/';
        $demo_base_url = 'http://crystal.code125.com/';
        $options = array(
            'main-demo' => array(
            	'label'=>'Blog Style 1',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-blog-1.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo1.jpg',
            	'demo_url'=> $demo_base_url . 'demo1/',
            	'homepage' => 'Homepage Blog 1',
            ),
            'dark' => array(
            	'label'=>'Dark Demo',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-dark.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo2.jpg',
            	'demo_url'=> $demo_base_url . 'demo2/',
            	'homepage' => 'Homepage Blog 1',
            ),
            'blog-2' => array(
            	'label'=>'Blog Style 2',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-blog-2.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo3.jpg',
            	'demo_url'=> $demo_base_url . 'demo3/',
            	'homepage' => 'Homepage Blog 2',
            ),
            'grid-1' => array(
            	'label'=>'Grid Style 1',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-grid-1.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo4.jpg',
            	'demo_url'=> $demo_base_url . 'demo4/',
            	'homepage' => 'Homepage Grid 1',
            ),
            'grid-2' => array(
            	'label'=>'Grid Style 2',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-grid-2.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo5.jpg',
            	'demo_url'=> $demo_base_url . 'demo5/',
            	'homepage' => 'Homepage Grid 2',
            ),
            'grid-3' => array(
            	'label'=>'Grid Style 3',
            	'xml' => $base_url . 'demo.xml',
            	'theme-options' => $base_url . 'theme-options-grid-3.txt',
            	'widgets' => $base_url . 'sidebar.json',
            	'img' => $base_url . 'demo6.jpg',
            	'demo_url'=> $demo_base_url . 'demo5/',
            	'homepage' => 'Homepage Grid 3',
            ),
            'shop' => array(
            	'label'=>'Shop',
            	'xml' => $base_url . 'demo-shop.xml',
            	'theme-options' => $base_url . 'theme-options-shop.txt',
            	'widgets' => $base_url . 'sidebar-shop.json',
            	'img' => $base_url . 'demo-shop.jpg',
            	'demo_url'=> $demo_base_url . 'shop/',
            	'homepage' => 'Homepage 1',
            ),
            'ar' => array(
            	'label'=>'Arabic Demo',
            	'xml' => $base_url . 'demo-ar.xml',
            	'theme-options' => $base_url . 'theme-options-ar.txt',
            	'widgets' => $base_url . 'sidebar-ar.json',
            	'img' => $base_url . 'demo-ar.jpg',
            	'demo_url'=> $demo_base_url . 'ar/',
            	'homepage' => 'Homepage Blog 1',
            ),
               
        );




        return $options;
    }

    function import_page() {
        ?>
        <div class="wrap about-wrap">
            <h2><?php echo $this->_theme_name; ?> Import tool</h2>
            <div id="welcome-panel" class="c5-main-panel welcome-panel">
                <div class="quick-panel-flexslider c5-successfully">
                    <div class="c5-quick-slide-wrap">
                        <?php $this->install_html(); ?>
                        <?php if (isset($_GET['activated'])) { ?>
                            <h2 ><span class="fa fa-check-square-o"></span> Successfully Activated...</h2>
                            <p class="about-description"><?php echo $this->_theme_name; ?> Theme has been activated, Thank you for choosing <?php echo $this->_theme_name; ?>, we recommend you to see the following resources for help.</p>
                        <?php } else { ?>
                            <p>Thank you for choosing <?php echo $this->_theme_name; ?>, we recommend you to see the following resources for help.</p>
                        <?php } ?>
                    </div>


                    <div class="feature-section col three-col clearfix">

                        <div class="col-1">
                        	<h4>Quick Setup</h4>
                        	<p>We grouped the most settings you might need to set in your initial setup, we recommend to install a demo first then start the quick setup process.</p>
                        	<a href="<?php echo admin_url('index.php?page=c5-quick-setup'); ?>" target="_blank" class="button button-primary button-large">Start Here</a>
                        </div>
                        
                        <div class="col-2 ">
                        	<h4>Check Online Documentation</h4>
                        	<p>Check our online documentation for more updated on how to use your theme and make the best of it.</p>
                        	<a href="http://crystal.code-125.com/documentation/" target="_blank" class="button button-primary button-large">Check it here</a>
                        </div>
                        <div class="col-3 last-feature">
                        	<h4>Check Online Video Tutorials</h4>
                        	<p>Check our online video tutorials to make the best out of this product.</p>
                        	<a href="https://www.youtube.com/watch?v=MItqDK2RarM&list=PLoZkybG-SsuL9L2GycioDsLPddL7koUIk" target="_blank" class="button button-primary button-large">Check it here</a>
                        </div>


                    </div>


                    <h2 class="c5-demo-heading">Choose one of the following demos to install</h2>

                    <div class="feature-section col three-col clearfix">
                        <?php
                        $counter = 1;
                        foreach ($this->all_demos() as $id => $info) {
                            $class = '';
                            if ($counter == 3) {
                                $class = ' last-feature ';
                            }
                            ?>
                            <div class="col-<?php echo $counter ?> <?php echo $class ?>">
                                <div class="c5-import-signle">
                                    <h4><a href="<?php echo $info['demo_url'] ?>" target="_blank"><?php echo $info['label'] ?></a></h4>
                                    <div class="item-wrap">
                                        <div class="img-wrap">
                                            <img src="<?php echo $info['img'] ?>" alt="" />
                                        </div>
                                        <div class="buttons-wrap">
                                            <a class="button-primary button-large button c5-install-button" href="<?php echo admin_url('tools.php?page=c5-demo-import&demo_type=demo&demo_id=' . $id); ?>" >Install Complete Demo</a>
                                            <a class="button-primary button-large button c5-install-button" href="<?php echo admin_url('tools.php?page=c5-demo-import&demo_type=widget&demo_id=' . $id); ?>" >Install Only Widgets</a>
                                            <a class="button-primary button-large button c5-install-button" href="<?php echo admin_url('tools.php?page=c5-demo-import&demo_type=options&demo_id=' . $id); ?>">Install Only Theme Options</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $counter++;
                            if ($counter == 4) {
                                $counter = 1;
                            }
                        }
                        ?>


                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    function update_categories_colors() {
        $old_categories = array(
            'business' => array(
                'color' => '#8bc34a',
                'icon' => 'fa fa-building-o',
            ),
            'entrepreneurship' => array(
                'color' => '#00bcd4',
                'icon' => 'fa fa-lightbulb-o',
            ),
            'politics' => array(
                'color' => '#607d8b',
                'icon' => 'fa fa-globe',
            ),
            'random' => array(
                'color' => '#0277bd',
                'icon' => 'fa fa-random',
            ),
            'tech' => array(
                'color' => '#0277bd',
                'icon' => 'fa fa-laptop',
            ),
        );
        foreach ($old_categories as $slug => $values) {
            $cat = get_category_by_slug($slug);
            $term_id = $cat->term_id;

            update_option('c5_term_meta_category_' . $term_id . '_use_custom_colors', 'on');
            update_option('c5_term_meta_category_' . $term_id . '_primary_color', $values['color']);
            update_option('c5_term_meta_category_' . $term_id . '_title_color', $values['color']);
            update_option('c5_term_meta_category_' . $term_id . '_icon', $values['icon']);
        }
    }

    function update_categories_ids() {
        $old_categories = array(
            'business' => 2,
            'entrepreneurship' => 3,
            'politics' => 4,
            'random' => 5,
            'tech' => 6
        );
        $replace_array = array();
        foreach ($old_categories as $slug => $old_id) {
            $cat = get_category_by_slug($slug);
            if ($cat->term_id != $old_id) {
                $replace_array[$old_id] = $cat->term_id;
            }
        }

        if (count($replace_array) == 0) {
            return;
        }
        $args = array(
            'post_type' => 'page',
            'posts_per_page' => -1
        );
        // The Query
        $the_query = new WP_Query($args);

        // The Loop
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $raw_data = get_post_meta(get_the_ID(), 'c5ab_data', true);
                if ($raw_data != '') {
                    $raw_data = base64_decode($raw_data);
                    $data = unserialize($raw_data);
                    $raw_data = json_encode($data);
                    foreach ($replace_array as $old_ID => $new_ID) {
                        $raw_data = str_replace('post#category#' . $old_ID, 'post!#category!#' . $new_ID, $raw_data);
                    }
                    $raw_data = str_replace('post!#category!#', 'post#category#', $raw_data);

                    $data = json_decode($raw_data, true);
                    $raw_data = serialize($data);
                    $raw_data = base64_encode($raw_data);
                    update_post_meta(get_the_ID(), 'c5ab_data', $raw_data);
                }
            }
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        $page = get_page_by_title('Hello world!', 'OBJECT', 'post');
        wp_delete_post($page->ID);
    }

    function update_sidebars($base_url) {
//		$base_url = 'http://files.code125.com/master/main-sidebar.json';
        $get_data = wp_remote_get($base_url);

        if (is_wp_error($get_data))
            return false;

        $rawdata = isset($get_data['body']) ? $get_data['body'] : '';
        $options = json_decode($rawdata);
        $sidebars = $options[0];
        $data = array();
        foreach ($sidebars as $sidebar => $value) {
            $data[$sidebar] = $value;
        }
        $data['wp_inactive_widgets'] = array();
        update_option('sidebars_widgets', $data);
        $widgets = $options[1];

        foreach ($widgets as $widget => $value) {
            if ($widget != '_empty_') {
                $value = (array) $value;

                $new_value = array();
                foreach ($value as $key => $value_2) {
                    $new_value[$key] = (array) $value_2;
                }
                update_option('widget_' . $widget, $new_value);
            }
        }
    }

    /**
     * The main controller for the import theme options.
     *
     * @param string $file Path to the text file for importing
     */
    function import_theme_options($data_file) {
        $get_data = wp_remote_get($data_file);

        if (is_wp_error($get_data))
            return false;

        $rawdata = isset($get_data['body']) ? $get_data['body'] : '';
        $options = unserialize(ot_decode($rawdata));

        /* get settings array */
        $settings = get_option('option_tree_settings');

        /* has options */
        if (is_array($options)) {

            /* validate options */
            if (is_array($settings)) {

                foreach ($settings['settings'] as $setting) {

                    if (isset($options[$setting['id']])) {

                        $content = ot_stripslashes($options[$setting['id']]);

                        $options[$setting['id']] = ot_validate_setting($content, $setting['type'], $setting['id']);
                    }
                }
            }

            /* update the option tree array */
            update_option('option_tree', $options);
        }
    }

    function get_wp_options() {
        $args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $info_data = array(
            'primary_color',
            'icon'
        );
        $tax = 'category';
        $data = array();
        $categories = get_categories($args);
        foreach ($categories as $category) {
            $info = array();
            foreach ($info_data as $single_info) {
                $info[$single_info] = get_option('c5_term_meta_category_' . $category->term_id . '_' . $single_info);
            }
            $data[$category->slug] = $info;
        }

        print_r(base64_encode(serialize($data)));
    }

    function get_attachment_id_from_filename($name) {
        global $wpdb;

        $query = "SELECT guid FROM {$wpdb->posts} WHERE guid LIKE '%{$name}%'";
        $id = $wpdb->get_var($query);

        return $id;
    }

}

$c5_import_demo = new C5_theme_activation();
$c5_import_demo->hook();
?>