		</div>
			<footer class="footer " role="contentinfo">
				<?php
				global $c5_footerdata;
				 global $c5_skindata;
				 global $c5_skip_page_width;
				 $c5_skip_page_width = true;
				 if(C5_simple_option){
				 	$c5_skindata['footer_default'] = ot_get_option('footer_template');
				 	
				 }
				 
				 $footer_enable = $c5_footerdata['footer_enable'];
				 if ($footer_enable != 'off') {
				 $color_mode = 'c5-content-dark';
				 $footer_background = $c5_footerdata['footer_background'];
				 if ($footer_background != '') {
				 	$lum = c5_get_lum_hex($footer_background);
				 	
				 	if ($lum<170) {
				 		$color_mode = 'c5-content-dark';
				 	}else {
				 		$color_mode = 'c5-content-light';
				 	}
				 }
				 ?>
					<div class="footer-main  ">
						<div class="<?php echo $color_mode; ?> c5-main-width-wrap">
						<?php 
						if($c5_skindata['footer_default']!=''){
							
							echo do_shortcode('[c5ab_template id="'.$c5_skindata['footer_default'].'"]');
						}
						echo '<div class="clearfix"></div>';
						
						
						 ?>
						</div>
					</div>
				<?php 
				}
				$footer_copyrights_enable = $c5_footerdata['footer_copyrights_enable'];
				if ($footer_copyrights_enable != 'off') {
					$color_mode = 'c5-content-dark';
					$footer_copyrights_background = $c5_footerdata['footer_copyrights_background'];
					if ($footer_copyrights_background != '') {
						$lum = c5_get_lum_hex($footer_copyrights_background);
						
						if ($lum<170) {
							$color_mode = 'c5-content-dark';
						}else {
							$color_mode = 'c5-content-light';
						}
					}
					echo '<div class="footer-bar clearfix"><div class="'.$color_mode.' c5-main-width-wrap">';
					$footer_copyrights = $c5_footerdata['footer_copyrights'];
					if($footer_copyrights!=''){
						echo '<div class="c5-left">';
						echo '<div class="footer_nav">';
						wp_nav_menu( array( 'menu' => 'menu-footer', 'theme_location' => 'footer' ) );
						echo '</div>';
						echo '</div>';
						echo '<div class="c5-right">';
						echo '<div class="c5-copyrights">';
						
						echo wp_kses($footer_copyrights,array(
							'a' => array(
								'href' => array(),
						        'title' => array(),
						         'class' => array()
						     ),
						     'span'=>array(
						     	'class' => array()
						     )
						     ));
						
						echo '</div>';
						echo '</div>';
					}
					
					
					$code = '';
					$social_icons = $c5_footerdata['social_icons'];
					if ($social_icons) {
					    $code .= '[c5ab_social_icons]';
					    foreach ($social_icons as $social_icon) {
					        $code .= '[c5ab_social_icon icon="' . esc_attr($social_icon['icon']) . '" link="' . esc_url($social_icon['link']) . '" title="' . esc_attr($social_icon['title']) . '" ]';
					    }
					    $code .= '[/c5ab_social_icons]';
					}
					echo '<div class="c5-right"><div class="c5-social-footers"></div>' . do_shortcode($code) .'</div>';
					echo '<div class="clearfix"></div></div></div>';
				}
					 ?>
				<style>
				
				.footer .footer-main{
					background: <?php echo $c5_footerdata['footer_background'] ?>;
				}
				.footer .footer-bar{
					background: <?php echo $c5_footerdata['footer_copyrights_background'] ?>;
				}
				</style>
			</footer>
		
		
	</div>
	</div>
		<p id="gotop"><span class="fa fa-sort-asc"></span></p>
		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>	
<script>
jQuery("ul.top-nav li.menu-item-has-children > a:first-child").append("<b class='caret'></b>");
</script>
	</body>

</html>
