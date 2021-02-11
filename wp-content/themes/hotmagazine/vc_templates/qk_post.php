<?php
extract(shortcode_atts(array(
	'id'=>'',
	'class'=>'',
	'thumbsize'=>'',
	'cat'=>'',
), $atts));
$custom  = hotmagazine_custom();
if($class!=''){
	$class = $class;
}else{
	$class = 'default-size';
}


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
if($cat!='' and !is_rtl()){
$category = get_term_by('slug', $cat, 'category');
$cat_id = $category->term_id;
}

?>
<?php 
      if($posts_list->have_posts()) :
        $i=1; while($posts_list->have_posts()) : $posts_list->the_post(); 
?>
<?php $id= get_the_ID(); ?>
<div class="news-post image-post <?php echo esc_attr($class);?>">
	<?php if(has_post_thumbnail($id=$id)){ ?>
	<div class="thumb-wrap">
		<img src="<?php echo hotmagazine_thumbnail_url($thumbsize, $id); ?>" alt="<?php the_title(); ?>">
		<?php if(is_user_logged_in()){ echo '<a target="_blank" class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
	</div>
	<?php if(get_post_meta($id, '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
	<?php }else{ ?>
 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
 	<?php } ?>
	<div class="hover-box">
		<div class="inner-hover">

			<?php $score = get_post_meta($id, '_hotmagazine_score', true); $score_text = get_post_meta($id, '_hotmagazine_score_text', true); ?>
					<?php if($score!=''){ ?>
					<div class="rate-level">
						<p><span><?php echo esc_html($score); ?></span> <?php echo esc_html($score_text); ?></p>
					</div>
			<?php } ?>
			<?php if($custom['body_style']!='' and $custom['body_style']!='game' ){ ?>
			<?php 
			if($cat!='all' and $cat !=''){ ?>


			<a class="category-post <?php echo esc_html($cat); ?>" href="<?php echo get_category_link( $cat_id ); ?>"><?php echo esc_html(get_cat_name( $cat_id )); ?></a> 
			<?php	}else{ 

			$category_detail=get_the_category($id);//$post->ID
			foreach($category_detail as $cd){ ?>
			<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
			<?php } 

				}?>
				
			<?php } ?>
			<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
			<ul class="post-tags">
				<li><i class="fa fa-clock-o"></i><?php echo get_the_time(get_option( 'date_format' ), $id); ?></li>
				<li><a href="<?php echo get_permalink($id); ?>"><i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id );?></span></a></li>
			</ul>
			<?php if($custom['body_style']!='' and $custom['body_style']=='game' ){ ?>
			<?php 

				$post = get_post( $id );

				$excerpt =  $post->post_excerpt;

				echo wp_kses_post($excerpt);
			?>
			<?php }elseif(get_post_meta($id, '_hotmagazine_caption', true)!=''){ ?>
			<p> <?php echo get_post_meta($id, '_hotmagazine_caption', true); ?></p>
			<?php } ?>
		</div>
	</div>
</div>
<?php $i++; endwhile; ?>
<?php endif; wp_reset_postdata(); ?>
