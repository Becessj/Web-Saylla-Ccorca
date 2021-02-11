<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $title
 * @var $item
 * @var $cat
 * @var $cat_ids
 * @var $class
 * @var $thumbsize
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class = $title = $thumbsize = $item = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

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
if($cat_ids!=''){
	$args['cat'] = $cat_ids;
}elseif($cat!='all'){
  if ( is_rtl() ) {
  	$args['cat'] = $cat;
  }else{
  	$args['category_name'] = $cat;
  }
}
$portfolio = new WP_Query($args);
if($item!=''){
	$item = $item;
}else{
	$item = '4';
}
$custom  = hotmagazine_custom();
?>

<!-- carousel box -->
	<div class="carousel-box owl-wrapper <?php echo esc_attr($class); ?>">
		<?php if($title!=''){ ?>
		<div class="title-section">
			<h1><span><?php echo esc_html($title); ?></span></h1>
		</div>
		<?php } ?>
		<div class="owl-carousel" data-num="<?php echo esc_attr($item); ?>" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">
		
			
			<?php 
		      if($portfolio->have_posts()) :
		             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
		      ?>
		      <?php if($custom['body_style']!='' and $custom['body_style']=='showbiz' ){ ?>

		      		<div class="item news-post fashion-post">
						<div class="post-gallery">
							<?php the_post_thumbnail($thumbsize); ?>
						</div>
						<div class="post-content">
							<?php 
							$id = get_the_ID();
							$category_detail=get_the_category($id);//$post->ID
							foreach($category_detail as $cd){ ?>
							<a class="<?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a>
							<?php } ?>
							<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?php echo get_the_time(get_option( 'date_format' ), $id); ?></li>
								<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
								<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
							</ul>
						</div>
					</div>

			  <?php }elseif($custom['body_style']!='' and $custom['body_style']=='design' ){ ?>

		      <div class="item">
				<div class="news-post image-post4">
					<?php the_post_thumbnail($thumbsize); ?>

					<div class="hover-box">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
							<li><?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						</ul>
					</div>
				</div>
			</div>
		     <?php }else{ ?>

			<div class="item news-post image-post3 <?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?> video-post <?php } ?>">
				<?php the_post_thumbnail($thumbsize); ?>
				<?php $id = get_the_id(); ?>
				<?php $score = get_post_meta($id, '_hotmagazine_score', true); $score_text = get_post_meta($id, '_hotmagazine_score_text', true); ?>
				<?php if($score!=''){ ?>
				<div class="rate-level">
					<p><span><?php echo esc_html($score); ?></span> <?php echo esc_html($score_text); ?></p>
				</div>
				<?php } ?>
				<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
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
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</div>
	<!-- End carousel box -->