<?php
extract(shortcode_atts(array(
	'id'=>'',
	'class'=>'',
	'wrap'=>'',
	'thumb'=>'',
	'thumbsize'=>'',
	'cat'=>'',
), $atts));

$args = array(
	'post_type' => 'post',
	'posts_per_page' =>1,
);


if($cat!='' and $cat!='all'){
  if ( is_rtl() ) {
  	$args['cat'] = $cat;
  }else{
  	$args['category_name'] = $cat;
  }
}else{
	$args['p'] = $id;
}

$posts_list = new WP_Query($args);

?>
<?php 
      if($posts_list->have_posts()) :
        $i=1; while($posts_list->have_posts()) : $posts_list->the_post(); 
?>
<?php $id= get_the_ID(); ?>
<?php $custom  = hotmagazine_custom(); ?>
<?php if($wrap!=''){ ?>
	<<?php echo esc_html($wrap); ?> class="item">
<?php } ?>

<div class="news-post image-post4">
	<div class="post-gallery">
		<?php if(has_post_thumbnail($id=$id)){ ?>
		<div class="thumb-wrap">
			<img src="<?php echo hotmagazine_thumbnail_url($thumbsize, $id); ?>" alt="<?php the_title(); ?>">
			<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
		</div>
		<?php }else{ ?>
	 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
	 	<?php } ?>
		<?php 
		$category_detail=get_the_category($id);//$post->ID
		foreach($category_detail as $cd){ ?>
		<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
		<?php } ?>
	</div>
	<div class="post-content">
		<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
		<ul class="post-tags">
			<li><i class="fa fa-clock-o"></i><?php echo get_the_time(get_option( 'date_format' ), $id); ?></li>
			<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
			<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
		</ul>
	</div>
</div>

<?php if($wrap!=''){ ?>
	</<?php echo esc_html($wrap); ?>>
<?php } ?>

<?php $i++; endwhile; ?>
<?php endif; wp_reset_postdata(); ?>