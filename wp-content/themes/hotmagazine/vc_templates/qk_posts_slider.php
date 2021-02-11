<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $class
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$custom  = hotmagazine_custom();
$cla = 'bxslider';
if($custom['body_style']!='' and $custom['body_style']=='fashion' ){
	$cla = 'main-slider';
}

?>

<div class="<?php if($class!=''){ echo esc_attr($class); }else{ ?> image-post-slider <?php } ?>">
	<ul class="<?php echo esc_attr($cla); ?>">
		
		<?php echo wpb_js_remove_wpautop($content); ?>

	</ul>
	<?php if($custom['body_style']!='' and $custom['body_style']=='fashion' ){ ?>
	<div class="custom-slider-arrows">
		<div class="container">
			<div id="slider-prev"></div>
			<div id="slider-next"></div>
		</div>
	</div>
	<?php } ?>
</div>
