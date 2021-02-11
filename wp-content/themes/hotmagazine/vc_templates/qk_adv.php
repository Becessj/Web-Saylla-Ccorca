<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $caption
 * @var $image
 * @var $image2
 * @var $image3
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$title = $sub_title = $image = $caption = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


?>
<?php
  $img1 = wp_get_attachment_image_src($image,'full');
  $img1 = $img1[0];
  $img2 = wp_get_attachment_image_src($image2,'full');
  $img2 = $img2[0];
  $img3 = wp_get_attachment_image_src($image3,'full');
  $img3 = $img3[0];
?>
<!-- google addsense -->
<div class="advertisement">
  <?php if($img1!=''){ ?>
  <div class="desktop-advert">
    <span>Advertisement</span>
    <a href="<?php echo esc_url($caption); ?>">
      <img src="<?php echo esc_attr($img1); ?>" alt="adv">
    </a>
  </div>
  <?php } ?>
   <?php if($img2!=''){ ?>
  <div class="tablet-advert">
    <span>Advertisement</span>
    <a href="<?php echo esc_url($caption); ?>">
    <img src="<?php echo esc_attr($img2); ?>" alt="adv">
  </a>
  </div>
  <?php } ?>
   <?php if($img3!=''){ ?>
  <div class="mobile-advert">
    <span>Advertisement</span>
    <a href="<?php echo esc_url($caption); ?>">
    <img src="<?php echo esc_attr($img3); ?>" alt="adv">
  </a>
  </div>
  <?php } ?>
</div>
<!-- End google addsense -->

