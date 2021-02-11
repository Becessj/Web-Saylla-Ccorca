<?php
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $order
 * @var $cat
 * @var $class
 * @var $order2
 * @var $thumbsize
 * @var $filter
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_qk_team
 */
$order =  $cat = $class = $order2 = $thumbsize = $filter = '';
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
if($cat!='all'){
  if ( is_rtl() ) {
  	$args['cat'] = $cat;
  }else{
  	$args['category_name'] = $cat;
  }
}
if($order2==''){
	$order2 = 4;
}else{
	$order2 = $order2;
}

$portfolio = new WP_Query($args);
if($cat!='all' and !is_rtl()){
$category = get_term_by('slug', $cat, 'category');
$cat = $category->term_id;
}
?>
<?php 
	$children = get_term_children($cat, 'category');
	if($children){ ?>
	<?php $custom  = hotmagazine_custom(); ?>
	<?php if($filter=='' or $filter!='horizontal' ){ ?>
	
	<div class="filter-block">
		<ul class="filter-posts">
			<li><a class="active" href="#" data-cat="<?php echo esc_attr($cat); ?>">All</a></li>
			<?php foreach($children as $child){ ?>
			<li><a href="#" data-cat="<?php echo esc_attr($child); ?>"><?php echo get_cat_name($child);?></a></li>
			<?php } ?>
		</ul>
	</div>
	<?php }else{  ?>
		<ul class="horizontal-filter-posts">
			<li><a class="active" href="#" data-cat="<?php echo esc_attr($cat); ?>">All</a></li>
			<?php foreach($children as $child){ ?>
			<li><a href="#" data-cat="<?php echo esc_attr($child); ?>"><?php echo get_cat_name($child);?></a></li>
			<?php } ?>
		</ul>
	<?php } ?>
	<div class="posts-filtered-block <?php if($filter=='horizontal' ){ ?> block-full<?php }else{ echo 'block-ha'; } ?>" id="content_<?php echo esc_attr($cat); ?>">
		
		<div class="<?php echo esc_attr($class); ?> owl-wrapper">
			<?php if($filter!='horizontal' ){ ?>
			
			<h1><?php echo get_cat_name($cat);?></h1>
			<?php } ?>
			<div class="owl-carousel" data-num="<?php echo esc_attr($order2); ?>" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">
			
				<?php 
	      if($portfolio->have_posts()) :
	             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
	      ?>
	      <?php if(get_post_format()=='avideo'){ ?>
	      	<div class="item news-post video-post">
				<?php if(has_post_thumbnail()){ ?>
				<?php the_post_thumbnail($thumbsize); ?>
				<?php }else{ ?>
				<img src="http://placehold.it/270x200" />
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
	      <?php }else{ ?>
			<div class="item news-post standard-post">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail($thumbsize); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
					<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
				</div>
				<div class="post-content">
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<?php if($order2<5){ ?>
						<li><?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

			</div>
		</div>
	</div>


<?php }else{
		
?>
<div class="<?php echo esc_attr($class); ?> owl-wrapper">
	
	<?php if($cat!='all' and $class!='features-video-box' and $order2!=$order){ ?>
	
	
	<div class="title-section">
		<h1><span>Latest <?php echo get_cat_name($cat);?></span></h1>
	</div>
	<?php } ?>
	<div class="owl-carousel" data-num="<?php echo esc_attr($order2); ?>" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">
		
		<?php 
	      if($portfolio->have_posts()) :
	             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
	      ?>
	      <?php if(get_post_format()=='svideo'){ ?>
	      	<div class="item news-post video-post">
				<?php if(has_post_thumbnail()){ ?>
				<?php the_post_thumbnail($thumbsize); ?>
				<?php }else{ ?>
				<img src="http://placehold.it/270x200" />
				<?php } ?>

				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play-circle-o"></i></a>
				<div class="hover-box">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					</ul>
				</div>
			</div>
	      <?php }else{ ?>
			<div class="item news-post standard-post">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail($thumbsize); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
					<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
				</div>
				<div class="post-content">
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<?php if($order2<5){ ?>
						<li><?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</div>
<?php } ?>
