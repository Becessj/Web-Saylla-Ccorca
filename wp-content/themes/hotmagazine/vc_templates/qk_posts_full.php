<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $orderby
 * @var $offset
 * @var $cat
 * @var $title
 * @var $rate
 * @var $thumb
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $offset = $title = $thumb = $rate = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($thumb!=''){
	$thumb_col = $thumb;
	$content_col = 12- $thumb;
}else{
	$thumb_col = '5';
	$content_col = '7';
}


?>
<?php 
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$args = array(
	'post_type' => 'post',
	'posts_per_page' =>$order,
    'paged' => $paged,
);
if($cat!='all'){
  if ( is_rtl() ) {
    $args['cat'] = $cat;
  }else{
    $args['category_name'] = $cat;
  }
}
if($offset!=''){
  $args['offset'] = $offset;
}
if($orderby!=''){
  $args['order'] = $orderby;
}
$portfolio = new WP_Query($args);

?>

<?php $custom  = hotmagazine_custom(); ?>

<?php if($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
      <div class="article-box">
        <?php 
          if($portfolio->have_posts()) :
                 $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
        ?>

        <?php if($i==3 and $order>=6){ ?>
            <?php echo do_shortcode($custom['adv-editor']); ?>

        <?php }?>

        <div class="news-post standard-post2">
           <div class="post-gallery">
            <?php if(has_post_thumbnail($id=$id)){ ?>
          <div class="thumb-wrap">
            <img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
            <?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
          </div>
          <?php }else{ ?>
            <img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
          <?php } ?>
          
          </div>
          <div class="post-title">
            <h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
            <ul class="post-tags">
              <li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
              <li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
              <li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
            </ul>
          </div>
            <div class="post-content">
              <?php the_excerpt(); ?>
              <a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-angle-right"></i><span><?php esc_html_e('Read More','hotmagazine'); ?></span></a>
            </div>
          </div>

        <?php $i++; endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?> 
      </div>
      <!-- Pagination box -->
      <div class="pagination-box">
        <?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
      </div>

<?php }else{  ?>
<!-- grid box -->
<div class="grid-box">

<?php 
  if($portfolio->have_posts()) :
         $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
?>

<?php if($i==3){ ?>
		<?php echo do_shortcode($custom['adv-editor']); ?>

<?php }?>
<?php get_template_part( 'posts/full', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

<?php $i++; endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>	

	

</div>
<!-- End grid box -->

<!-- Pagination box -->
<div class="pagination-box">
	<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
</div>
<!-- End Pagination box -->
<?php } ?>
