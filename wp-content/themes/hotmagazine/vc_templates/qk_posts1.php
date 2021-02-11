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
 * @var $class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class= $offset = $title = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$custom  = hotmagazine_custom();


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

?>
<div class="item">
	<?php 
      if($portfolio->have_posts()) :
             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
    ?>
    <?php if($i==1){ ?>
    <?php if($custom['body_style']!='' and $custom['body_style']=='sport' ){ ?>
    	<div class="news-post standard-post2">
			<div class="post-gallery">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="post-title">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
				<ul class="post-tags">
					<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
					<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
				</ul>
			</div>
		</div>
    <?php }elseif($custom['body_style']!='' and $custom['body_style']=='tech' ){ ?>
    	<div class="news-post standard-post2">
			<div class="post-gallery">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="post-title">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
				<ul class="post-tags">
					<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
					<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
				</ul>
			</div>
		</div>
    <?php }elseif($class=='standard' ){ ?>
    	<div class="news-post standard-post2">
			<div class="post-gallery">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="post-title">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
				<ul class="post-tags">
					<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
					<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
					
				</ul>
			</div>
		</div>
    <?php }else{ ?>
	<div class="news-post image-post2">
		<div class="post-gallery">
			<?php the_post_thumbnail(); ?>
			<div class="hover-box">
				<div class="inner-hover">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<ul class="list-posts">
	<?php }else{  ?>

		<li>
			<?php if($custom['body_style']!='' and $custom['body_style']!='sport' and $custom['body_style']!='tech' ){ ?>
			<?php if(has_post_thumbnail()){ ?>
			<?php the_post_thumbnail('thumbnail'); ?>
			<?php } ?>
			<?php } ?>
			<div class="post-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
				<ul class="post-tags">
					<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
				</ul>
			</div>
		</li>
	 <?php if($i==$portfolio->post_count){ ?>
	</ul>	
	<?php } ?>	
	<?php } ?>
	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>			
</div>