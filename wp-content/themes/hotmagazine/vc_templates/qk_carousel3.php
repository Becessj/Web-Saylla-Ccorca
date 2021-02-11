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
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $offset = $title = '';
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
$portfolio = new WP_Query($args);

?>

<!-- carousel box -->
<div class="carousel-box owl-wrapper">

	<div class="title-section">
		<h1><span><?php echo esc_html($title); ?></span></h1>
	</div>

	<div class="owl-carousel" data-num="2" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">
		<?php 
	      if($portfolio->have_posts()) :
	             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
	    ?>
	    <?php if($i%2==1 or $i==1){ ?>
		<div class="item">
		<?php } ?>
			<?php $id = get_the_ID(); ?>
			<div class="news-post image-post2">
				<div class="post-gallery">
					<?php if(has_post_thumbnail($id=$id)){ ?>
					<div class="thumb-wrap">
						<img src="<?php echo hotmagazine_thumbnail_url('medium', $id); ?>" alt="<?php the_title(); ?>">
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
								<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php if($i%2==0 or $i == $portfolio->post_count){ ?>    	
		</div>
		<?php } ?>
		<?php $i++; endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>	

	</div>

</div>
<!-- End carousel box -->