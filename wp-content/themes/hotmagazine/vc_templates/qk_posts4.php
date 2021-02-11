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
if($cat!='all' and !is_rtl()){
$category = get_term_by('slug', $cat, 'category');
$cat = $category->term_id;
}
?>


<?php 
  if($portfolio->have_posts()) :
         $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
?>

<?php if($i==0){ ?>
<?php $id = get_the_ID(); ?>
<div class="news-post image-post2">
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
<?php } ?>

<?php if($i%2==1 or $i==1){ ?>
<div class="row">
<?php } ?>
<?php if($i!=0){ ?>
	<div class="col-md-6">
	<?php $id = get_the_ID(); ?>
		<div class="item news-post standard-post">
			<div class="post-gallery">
				<?php the_post_thumbnail(); ?>
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
	</div>
<?php } ?>
<?php if($i!=0){ ?>
<?php if($i%2==0 or $i == $portfolio->post_count){ ?>    
      </div>
<?php } ?>
<?php } ?>

<?php $i++; endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>		