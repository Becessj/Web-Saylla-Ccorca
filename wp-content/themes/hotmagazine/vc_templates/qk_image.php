<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $caption
 * @var $image
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$title = $sub_title = $image = $caption = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


?>

<div class="image-content">
  <div class="image-place">
    <?php
      $img = wp_get_attachment_image_src($image,'full');
      $img = $img[0];
    ?>
    <img src="<?php echo esc_attr($img); ?>" alt="Slide" class="img-responsive">
    <div class="hover-image">
      <a class="zoom" href="<?php echo esc_attr($img); ?>"><i class="fa fa-arrows-alt"></i><span></a>
    </div>
  </div>
  <span class="image-caption"><?php echo esc_html($caption); ?></span>
</div>

