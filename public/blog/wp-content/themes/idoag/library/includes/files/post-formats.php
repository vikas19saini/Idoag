<?php 


//deactivate WordPress function
remove_shortcode('gallery', 'gallery_shortcode');

//activate own function
add_shortcode('gallery', 'code125_gallery_shortcode');

//the own renamed function
function code125_gallery_shortcode($attr) {
    $post = get_post();

    static $instance = 0;
    $instance++;

    if (!empty($attr['ids'])) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if (empty($attr['orderby']))
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ($output != '')
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
                'order' => 'ASC',
                'orderby' => 'menu_order ID',
                'id' => $post ? $post->ID : 0,
                'itemtag' => 'dl',
                'icontag' => 'dt',
                'captiontag' => 'dd',
                'columns' => 3,
                'size' => 'thumbnail',
                'include' => '',
                'exclude' => ''
                    ), $attr, 'gallery'));

    $id = intval($id);
    if ('RAND' == $order)
        $orderby = 'none';

    if (!empty($include)) {
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif (!empty($exclude)) {
        $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    } else {
        $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
    }

    if (empty($attachments))
        return '';

    if (is_feed()) {
        $output = "\n";
        foreach ($attachments as $att_id => $attachment)
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html('post');
    if (!isset($valid_tags[$itemtag]))
        $itemtag = 'dl';
    if (!isset($valid_tags[$captiontag]))
        $captiontag = 'dd';
    if (!isset($valid_tags[$icontag]))
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if (apply_filters('use_default_gallery_style', true))
        $gallery_style = "
     		<style type='text/css'>
     			#{$selector} {
     				margin: auto;
     			}
     			#{$selector} .gallery-item {
     				float: {$float};
     				margin-top: 10px;
     				text-align: center;
     				width: {$itemwidth}%;
     			}
     			#{$selector} img {
     				
     			}
     			#{$selector} .gallery-caption {
     				margin-left: 0;
     			}
     			/* see gallery_shortcode() in wp-includes/media.php */
     		</style>";
    $size_class = sanitize_html_class($size);
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} flexslider features '><ul class='slides gallery_slider'>";
    $output = apply_filters('gallery_style', $gallery_style . "\n\t\t" . $gallery_div);

    $i = 0;
    foreach ($attachments as $id => $attachment) {
       
       $size = c5ab_generate_image_size($GLOBALS['c5_content_width'], round( $GLOBALS['c5_content_width']*0.7), true);
		$itemtag = 'li';
        $i++;

        $full_img = wp_get_attachment_image_src($id, 'full', false);

        $image_output = wp_get_attachment_image($id, $size, false);

        $image_meta = wp_get_attachment_metadata($id);

        $orientation = '';
        if (isset($image_meta['height'], $image_meta['width']))
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
     			<{$icontag} class='gallery-icon {$orientation}'><a href=\"" . $full_img[0] . "\" class='' >
     				$image_output
     			</a></{$icontag}>";
        if ($captiontag && trim($attachment->post_excerpt)) {
            $output .= "
     				<{$captiontag} class='wp-caption-text gallery-caption'>
     				" . wptexturize($attachment->post_excerpt) . "
     				</{$captiontag}></a>";
        }
        $output .= "</{$itemtag}>";
    }

    $output .= "</ul></div>\n";

    return $output;
}

 ?>