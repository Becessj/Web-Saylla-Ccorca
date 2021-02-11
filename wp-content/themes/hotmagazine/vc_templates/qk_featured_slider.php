<?php 
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $title
 * @var $cat
 * @var $class
 * @var $thumbsize
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class = $title = $thumbsize = '';
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
    'paged' => $paged,
    'meta_query' => array(
				array(
					'key'     => '_hotmagazine_featured',
					'value'   => 'on',
					'compare' => 'IN',
				),
	)
);
if($cat!='all'){
  if ( is_rtl() ) {
  	$args['cat'] = $cat;
  }else{
  	$args['category_name'] = $cat;
  }
}
$portfolio = new WP_Query($args);

?>
<?php if($title!=''){ ?>
<div class="title-section">
		<h1><span class="fashion"><?php echo esc_html($title); ?></span></h1>
	</div>
<?php } ?>
	<div class="image-post-slider">
		<ul class="bxslider">
			<?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>
			<li>
				<div class="news-post image-post2">
					<?php the_post_thumbnail($thumbsize); ?>
					<div class="hover-box">
						<div class="inner-hover">
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
						</div>
					</div>
				</div>
			</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>


		</ul>
	</div>	