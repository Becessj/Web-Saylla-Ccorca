<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $ids
 * @var $cat_ids
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
$cats_id = explode(",", $cat_ids);
if($cats_id[0]!=''){
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>4,
	    'paged' => $paged,
	    'cat' => $cats_id['0'],
	);
}else{
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>-1,
	    'paged' => $paged,
	    'post__in' => $posts_id,
	);
}


$portfolio = new WP_Query($args);

?>
<!-- slider-caption-box -->
<div class="slider-caption-box">
	<?php if($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
	<?php if($cats_id[0]!=''){ ?>
	<ul class="filter-slider-posts">
		<li><a href="#">Today</a></li>
		<?php $c =1; foreach($cats_id as $cat){ ?>
		<li><a <?php if($c==1){ ?> class="active" <?php } ?> id="cat_<?php echo esc_attr($cat); ?>" data-cat="<?php echo esc_attr($cat); ?>" href="#"><?php echo get_cat_name( $cat ) ?></a></li>
		<?php $c++; } ?>
	</ul>
	<?php } ?>
	<?php } ?>
	<div class="slider-wrap">
	<div class="slider-holder">
		<?php if($cats_id[0]!=''){ ?>
		<span><?php echo get_cat_name( $cats_id[0] ) ?></span>
		<?php } ?>
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

			<?php if($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
			<div class="news-post standard-post">
				<?php $id = get_the_ID(); ?>
				<div class="post-gallery">
					<?php if(has_post_thumbnail($id=$id)){ ?>
					<div class="thumb-wrap">
						<img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
						<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link().'">'.'edit</a>'; } ?>
					</div>
					<?php }else{ ?>
				 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
				 	<?php } ?>
				</div>
				<div class="post-content">
					<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
					</ul>
				</div>
			</div>
			<?php }elseif($custom['body_style']!='' and $custom['body_style']=='design' ){ ?>
				<div class="news-post image-post">
					<div class="post-gallery">
						<?php the_post_thumbnail(); ?>
						<div class="hover-box">
							<div class="inner-hover">
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
				<?php } }?>
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
	     <?php if($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
	     	<a data-slide-index="<?php echo esc_attr($i); ?>" href="">
				<?php 
					$title = get_the_title();
					
					echo esc_html($title); 
				?>
				
				<span><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></span>
				
			</a>
	     <?php }elseif($custom['body_style'] =='game' or $custom['body_style']=='design' ){ ?>
	     	<a data-slide-index="<?php echo esc_attr($i); ?>" href=""> <?php $id= get_the_ID(); ?>
				<img src="<?php echo hotmagazine_thumbnail_url('thumbnail', $id); ?>" alt="<?php the_title(); ?>">
				<?php the_title(); ?>
				<span><?php echo get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?></span>
			</a>
	     <?php }else{ ?>
			<a data-slide-index="<?php echo esc_attr($i); ?>" href="">
				<?php 
					$title = get_the_title();
					$len = strlen($title);
					if($len>40){ 
						$title  = substr($title, 0, 40).'...';
					}
					echo esc_html($title); 
				?>
				
			</a>
		<?php } ?>
		<?php $i++; endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>
</div>
<!-- End slider-caption-box -->