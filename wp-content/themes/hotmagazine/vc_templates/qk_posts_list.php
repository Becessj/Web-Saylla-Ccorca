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
 * @var $thumbsize
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $offset = $title = $thumb = $rate = $thumbsize = '';
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
<div class="article-box">
	<?php if($title!=''){ ?>
	<div class="title-section">
		<h1><span><?php echo esc_html($title); ?></span></h1>
	</div>
	<?php } ?>
	<div id="cat_<?php echo esc_attr($cat); ?>" >
	<?php 
      if($posts_list->have_posts()) :
             $i=1; while($posts_list->have_posts()) : $posts_list->the_post(); 
    ?>

    <?php if($order>=8 and $i==4){ ?>
			<?php echo do_shortcode($custom['adv-editor']); ?>

	<?php }?>

	<div class="news-post article-post">
		
		<div class="row">
			<div class="col-sm-<?php echo esc_attr($thumb_col); ?> <?php if ( is_rtl() ) { ?> pull-right<?php } ?>">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail($thumbsize); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
					<?php if($custom['body_style']!='' and $custom['body_style']=='travel' ){ ?>
					<?php
						$id = get_the_ID();  
						$category_detail=get_the_category($id);//$post->ID
						foreach($category_detail as $cd){ ?>
						<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
					<?php } ?>
					<?php } ?>
				<?php if($custom['body_style']!='' and $custom['body_style']=='fashion' ){ ?>
					<div class="hover-box">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-sm-<?php echo esc_attr($content_col); ?>">
				<div class="post-content">
					<?php 
						
						if($custom['body_style']!='' and $custom['body_style']=='fashion' ){ ?>
							<?php 
							$id = get_the_ID(); 
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
					<?php	}else{ ?>
					<?php if($custom['body_style']!='' and $custom['body_style']=='politics' ){ ?>
						<?php 
							$id = get_the_ID(); 
							$category_detail=get_the_category($id);//$post->ID
							foreach($category_detail as $cd){ ?>
							<a class="<?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 

							
							<?php } ?>
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						<li><i class="fa fa-eye"></i><?php echo hotmagazine_getPostViews(get_the_ID()); ?></li>
					</ul>
					<?php if($rate=='yes'){ if(function_exists('rw_the_post_rating')){ rw_the_post_rating($postID = false, $class = 'blog-post', $schema = false); }} ?>
					<?php the_excerpt(); ?>
					<?php if($rate!='yes' and $custom['body_style']!='politics'){ ?>
					<div class="clear"></div>
					<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><span><?php esc_html_e('Read More','hotmagazine'); ?></span></a>
					<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>
	<?php $i++; endwhile; ?>
	<?php endif; ?>
		
	</div>

<!-- End article box -->
<?php if($custom['body_style']!='' or $custom['body_style']=='game' ){ ?>

	<div class="center-button">
		<a class="load-morel" href="#" data-thumb="<?php echo esc_attr($thumb_col); ?>" data-cat="<?php echo esc_attr($cat); ?>" data-load="<?php echo esc_attr($order); ?>" data-found="<?php echo esc_attr($posts_list->found_posts); ?>"><?php  esc_html_e('Show me More','hotmagazine'); ?></a>
	</div>

<?php }else{ ?>
<!-- pagination box -->
<div class="pagination-box">
	<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
</div>
<!-- End Pagination box -->
<?php } ?>
</div><?php wp_reset_postdata(); ?>
