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
$posts_list = new WP_Query($args);
$custom  = hotmagazine_custom();
if($cat!='all' and !is_rtl()){
$category = get_term_by('slug', $cat, 'category');
$cat = $category->term_id;
}
?>

<!-- article box -->
<div class="article-box" ><div id="list2-<?php echo esc_attr($cat); ?>">
	<?php if($title!=''){ ?>
	<div class="title-section">
		<h1><span><?php echo esc_html($title); ?></span></h1>
	</div>
	<?php } ?>
	<?php 
      if($posts_list->have_posts()) :
             $i=1; while($posts_list->have_posts()) : $posts_list->the_post(); 
    ?>
    <?php if($custom['body_style']!='' and $custom['body_style']=='video' ){ ?>
    	<?php if($i%2==1 or $i==1){ ?>
            <div class="row"><ul class="list-posts2">
        <?php } ?>

			<li class="col-md-6">
				<div>
				<?php the_post_thumbnail(); ?>
				<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
							<div class="post-content">
							<?php
								$id = get_the_ID();  
								$category_detail=get_the_category($id);//$post->ID
								foreach($category_detail as $cd){ ?>
								<a class="<?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
							<?php } ?>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
									
								</ul>
								<?php 
								$post = get_post( get_the_ID() );

								$excerpt =  $post->post_excerpt;

								echo wp_kses_post($excerpt);
							?>
							</div>
				</div>
			</li>
			
		<?php if($i%2==0 or $i == $posts_list->post_count){ ?>    
	      </ul></div>
	    <?php } ?>
    <?php }elseif($custom['body_style']!='' and $custom['body_style']=='design' ){ ?>
	
		<?php if($i%2==1 or $i==1){ ?>
            <div class="row">
        <?php } ?>

			<div class="col-md-6">
				<div class="news-post article-post">
					<div class="row">
						<div class="col-sm-6">
							<div class="post-gallery">
								<?php the_post_thumbnail(); ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="post-content">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
									<li><?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
								</ul>
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		<?php if($i%2==0 or $i == $posts_list->post_count){ ?>    
	      </div>
	    <?php } ?>
	<?php }else{  ?>



    <?php if($i%2==1){ ?>
    <div class="news-post article-post">
		<div class="row">
			<div class="col-sm-<?php echo esc_attr($thumb_col); ?>">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail('medium'); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
					<div class="hover-box">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				</div>
			</div>
			<div class="col-sm-<?php echo esc_attr($content_col); ?>">
				<div class="post-content">
					<?php 
					$category_detail=get_the_category($id);//$post->ID
					foreach($category_detail as $cd){ ?>
					<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 

					
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
					</ul>
					<?php if($rate=='yes'){ rw_the_post_rating($postID = false, $class = 'blog-post', $schema = false); } ?>
				</div>
			</div>
		</div>
	</div>
	<?php }else{  ?>

	<div class="news-post article-post">
		<div class="row">
			<div class="col-sm-<?php echo esc_attr($content_col); ?>">
				<div class="post-content">
					<?php 
					$category_detail=get_the_category($id);//$post->ID
					foreach($category_detail as $cd){ ?>
					<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 

					
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
					</ul>
					<?php if($rate=='yes'){ rw_the_post_rating($postID = false, $class = 'blog-post', $schema = false); } ?>
				</div>
			</div>
			<div class="col-sm-<?php echo esc_attr($thumb_col); ?>">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail('medium'); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
					<div class="hover-box">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php } ?>
	<?php } ?>
	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>	
	
</div>
<?php if($custom['body_style']=='video' or $custom['body_style']=='design' ){ ?>
	<div class="center-button">
	  <a class="load-list2" href="#" data-cat="<?php echo esc_attr($cat); ?>" data-load="<?php echo esc_attr($order); ?>" data-found="<?php echo esc_attr($posts_list->found_posts); ?>"><i class="fa fa-refresh"></i> More from <?php echo get_cat_name($cat);?></a>
	</div>
<?php }else{  ?>
<!-- pagination box -->
<div class="pagination-box">
	<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
</div>
<!-- End Pagination box -->
<?php } ?>
</div>
<!-- End article box -->

