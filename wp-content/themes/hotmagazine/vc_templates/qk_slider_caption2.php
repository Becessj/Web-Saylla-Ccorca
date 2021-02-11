<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $ids
 * @var $cat
 * @var $class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $ids = $class = $cat_ids = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$custom  = hotmagazine_custom();
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$posts_id = explode(",", $ids);
$args = array(
		'post_type' => 'post',
		'posts_per_page' =>$order,
	    
	);
if($cat!='' and $cat!='all'){
  if ( is_rtl() ) {
  	$args['cat'] = $cat;
  }else{
  	$args['category_name'] = $cat;
  }
}else{
	$args['post__in'] = $posts_id;
}


$portfolio = new WP_Query($args);

?>

<!-- slider-caption-box -->
	<div class="slider-caption-box2">

		<div class="slider-holder">
			<ul class="slider-call">
				<?php 
			      if($portfolio->have_posts()) :
			             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
			      ?>
				
				<li>
					<?php $video = get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>
					<?php if($video !=''){ ?>

					<div class="news-post iframe-post">
						<!-- Vimeo -->
						<?php echo wp_oembed_get(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)); ?>
						<!-- End Vimeo -->
					</div>

					<?php }else{  ?>
						<div class="news-post image-post2">
							<div class="post-gallery">
								<?php $id = get_the_ID(); ?>
								<?php if(has_post_thumbnail($id=$id)){ ?>
								<div class="thumb-wrap">
									<img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
									<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link().'">'.'edit</a>'; } ?>
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
						</div>
					<?php } ?>
					
				</li>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
			</ul>
		</div>
		<div id="bx-pager">
			<?php 

			$portfolio = new WP_Query($args);
		      if($portfolio->have_posts()) :
		             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
		    ?>

			<a data-slide-index="<?php echo esc_attr($i); ?>" href="">
				<?php $id= get_the_ID(); ?>
				<img src="<?php echo hotmagazine_thumbnail_url('thumbnail', $id); ?>" alt="<?php the_title(); ?>">
				<?php the_title(); ?>
				<span><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></span>
			</a>

			<?php $i++; endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
	<!-- End slider-caption-box -->



