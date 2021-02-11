
<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $cat
 * @var $class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



?>

<div class="heading-news-box <?php echo esc_attr($class); ?>">

	<div class="owl-wrapper">
		<div class="owl-carousel" data-num="4" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">

			<?php echo wpb_js_remove_wpautop($content); ?>
			
		</div>
	</div>

</div>
