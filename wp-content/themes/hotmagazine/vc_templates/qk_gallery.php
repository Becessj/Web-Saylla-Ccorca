<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $caption
 * @var $images
 * @var $ids
 * @var $title
 * @var $thumbsize
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$title = $title = $images = $thumbsize = $ids = $caption = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$custom  = hotmagazine_custom();

$posts_id = explode(",", $ids);

?>

 <?php
  $images = explode(",", $images);

?>
<?php if($posts_id[0]!=''){ ?>
<?php 
$args = array(
    'post_type' => 'post',
    'posts_per_page' =>-1,
      'post__in' => $posts_id,
  );
$portfolio = new WP_Query($args);
?>
<!-- galery box -->
<div class="galery-box">

  <div class="title-section">
    <h1><span><?php echo esc_html($title); ?></span></h1>
  </div>

  <ul class="slider-call2">
   <?php 
      if($portfolio->have_posts()) :
             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
      ?>
    <li>
      <div class="news-post video-post">
        <?php the_post_thumbnail($thumbsize);?>
        <?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
        <a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
        <?php } ?>
        <div class="hover-box">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <ul class="post-tags">
            <li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
          <li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
          </ul>
        </div>
      </div>
    </li>
    <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
  </ul>
  <div id="bx-pager2">
    <?php 
    

    $portfolio = new WP_Query($args);
        if($portfolio->have_posts()) :
               $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
        ?>
    <a data-slide-index="<?php echo esc_attr($i); ?>" href=""><img src="<?php echo hotmagazine_thumbnail_url('', $id=get_the_ID()); ?>" alt="<?php the_title();?>"/></a>
   <?php $i++; endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>
<!-- End galery box -->
<?php }else{ ?>
<!-- galery box -->
<div class="galery-box">

  <div class="title-section">
    <h1><?php if($custom['body_style']!='' and $custom['body_style']!='travel' ){ ?><span><?php } ?><?php echo esc_html($title); ?><?php if($custom['body_style']!='' and $custom['body_style']!='travel' ){ ?></span><?php } ?></h1>
  </div>
  <?php if($custom['body_style']!='' and $custom['body_style']=='sport' ){ ?>
  <div class="left-holder">
  <?php } ?>
    <ul class="slider-call2">
     <?php foreach($images as $image){ ?>
     <?php $img = wp_get_attachment_image_src($image,'full'); ?>
      <li><img src="<?php echo esc_attr($img[0]); ?>" alt="gallery"/></li>
      <?php } ?>
    </ul>
    <?php if($custom['body_style']!='' and $custom['body_style']=='sport' ){ ?>
  </div>
  <?php } ?>
  <div id="bx-pager2">
    <?php $i=0; foreach($images as $image){ ?>
    <?php $img = wp_get_attachment_image_src($image,'thumbnail'); ?>
    <a data-slide-index="<?php echo esc_attr($i); ?>" href="#"><img src="<?php echo esc_attr($img[0]); ?>" alt="gallrey"/></a>
    <?php $i++; } ?>
  </div>
</div>
<!-- End galery box -->
<?php } ?>
