<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $cat
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $title = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



?>

<!-- carousel box -->
<div class="carousel-box owl-wrapper">

	<div class="title-section">
		<h1><span class="world"><?php echo esc_html($title); ?></span></h1>
	</div>

	<div class="owl-carousel" data-num="2" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">
	
		
		<?php echo wpb_js_remove_wpautop($content); ?>
		
		


	</div>

</div>
<!-- End carousel box -->