<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $offset
 * @var $cat
 * @var $thumb
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $offset = $title = $thumb = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



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
$portfolio = new WP_Query($args);

?>
<?php 
  if($portfolio->have_posts()) :
         $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
?>

 <?php if($i%2==1 or $i==1){ ?>
    <div class="row">
<?php } ?>  
	
	<div class="col-md-6">
		<div class="news-post image-post2">
			<div class="post-gallery">
				<?php $id = get_the_ID(); ?>
				<?php if(has_post_thumbnail($id=$id)){ ?>
				<div class="thumb-wrap">
					<img src="<?php echo hotmagazine_thumbnail_url('thumbnail', $id); ?>" alt="<?php the_title(); ?>">
					<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
				</div>
				<?php }else{ ?>
			 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
			 	<?php } ?>
				<div class="hover-box">
					<div class="inner-hover">
						<?php 
							$category_detail=get_the_category($id);//$post->ID
							foreach($category_detail as $cd){ ?>
							<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
							<?php } ?>
							<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
								<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
								<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
							</ul>
					</div>
				</div>
			</div>
			<div class="post-content">
				 <?php echo  the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
			</div>
		</div>
	</div>

<?php if($i%2==0 or $i == $portfolio->post_count){ ?>    
  </div>
<?php } ?>

<?php $i++; endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>		