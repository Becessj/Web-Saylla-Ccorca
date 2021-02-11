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
 * @var $cat_ids
 * @var $thumb
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $cat_ids = $offset = $title = $thumb = '';
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
$cats_id = explode(",", $cat_ids);
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
if($cat!='all' and !is_rtl()){
$category = get_term_by('slug', $cat, 'category');
$cat = $category->term_id;
}
?>
<?php if($cats_id[0]!=''){ ?>
	<ul class="category-filter-posts">
		<li><a class="active" href="#" data-order="<?php echo esc_attr($order); ?>">All</a></li>
		<?php $c =1; foreach($cats_id as $cat){ ?>
		<li><a id="cat_<?php echo esc_attr($cat); ?>" data-cat="<?php echo esc_attr($cat); ?>" data-order="<?php echo esc_attr($order); ?>" href="#"><?php echo get_cat_name( $cat ) ?></a></li>
		<?php $c++; } ?>
	</ul>
<?php } ?>
<div class="item" id="list_load">
	
	<ul class="list-posts">
		<?php 
	      if($portfolio->have_posts()) :
	             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
	    ?>
		<li>
			<?php if($thumb!='disable'){ ?>
			<?php if(has_post_thumbnail()){ ?>
			<?php the_post_thumbnail('small'); ?>
			<?php }else{ ?>
			<img src="http://placehold.it/80x70" />
			<?php } ?>
			<?php } ?>
			<?php $id = get_the_ID(); ?>
			<?php $score = get_post_meta($id, '_hotmagazine_score', true); $score_text = get_post_meta($id, '_hotmagazine_score_text', true); ?>
				<?php if($score!=''){ ?>
				<div class="rate-level">
					<p><span><?php echo esc_html($score); ?></span> <?php echo esc_html($score_text); ?></p>
				</div>
			<?php } ?>
			<div class="post-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
				<ul class="post-tags">
					<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
				</ul>
			</div>
		</li>
		<?php $i++; endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>	
		
	</ul>
</div>