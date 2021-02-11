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
 * @var $title
 * @var $pagination
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $offset = $title = $pagination = '';
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
if($pagination!='off'){
	$args['paged'] = $paged;
}
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
$custom  = hotmagazine_custom();
?>

<!-- grid-box -->
<div class="grid-box">
<?php if($title!=''){ ?>
	<div class="title-section">
		<h1><span class="world"><?php echo esc_html($title); ?></span></h1>
	</div>
<?php } ?>

	

	
		<?php 
	      if($portfolio->have_posts()) :
	             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
	    ?>
	    <?php if($i%3==1 or $i==1){ ?>
            <div class="row">
        <?php } ?>  
		<div class="col-md-4">
			<?php if($custom['body_style']!='' and $custom['body_style']=='video' ){ ?>
				<div class="item news-post standard-post">
					<div class="post-gallery">
						<?php the_post_thumbnail(); ?>
						<?php
							$id = get_the_ID();  
							$category_detail=get_the_category($id);//$post->ID
							$c=1; foreach($category_detail as $cd){ ?>
							<a class="category-post mun<?php echo $c; ?> <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
						<?php $c++; } ?>
						<?php if(get_post_format()=='video'){ ?>
					<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
					<?php } ?>
					</div>
					<div class="post-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
							<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
							<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
						</ul>
					</div>
				</div>
			<?php }elseif($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
				<div class="news-post standard-post">
					<div class="post-gallery">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="post-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
							<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
							<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
						</ul>
					</div>
				</div>
			<?php }else{ ?>
			<div class="news-post video-post">
				<?php the_post_thumbnail(); ?>
				 <?php if(get_post_format()=='video'){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play-circle-o"></i></a>
				<?php } ?>
				<div class="hover-box">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					</ul>
				</div>
			</div>
			<?php } ?>
		</div>	
		<?php if($i%3==0 or $i == $portfolio->post_count){ ?>    
              </div>
            <?php } ?>
		<?php $i++; endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

	<?php if($pagination!='off'){ ?>
	<!-- pagination box -->
	<div class="pagination-box">
		<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=$portfolio->max_num_pages); ?>
	</div>
	<!-- End pagination box -->
	<?php } ?>

</div>
<!-- End grid-box -->
