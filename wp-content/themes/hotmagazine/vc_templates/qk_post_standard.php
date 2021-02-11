<?php
extract(shortcode_atts(array(
	'id'=>'',
	'class'=>'',
	'wrap'=>'',
	'thumb'=>'',
), $atts));
$custom  = hotmagazine_custom();
?>
<?php if($custom['body_style']!='' and $custom['body_style']=='showbiz' ){ ?>
	<div class="news-post fashion-post full-size">
		<div class="post-gallery">
			<?php if(has_post_thumbnail($id=$id)){ ?>
	<div class="thumb-wrap">
		<img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
		<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
	</div>
	<?php }else{ ?>
 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
 	<?php } ?>
		</div>
		<div class="post-content">
			<?php 
				$category_detail=get_the_category($id);//$post->ID
				foreach($category_detail as $cd){ ?>
				<a class="<?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a>
				<?php } ?>
			<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
			<ul class="post-tags">
				<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
				<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
				<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
			</ul>
			<?php 
				$post = get_post( $id );

				$excerpt =  $post->post_excerpt;

				echo wp_kses_post($excerpt);
			?>
		</div>
	</div>
<?php }else{  ?>
<div class="news-post standard-post2">
	<div class="post-gallery">
		<?php if(has_post_thumbnail($id=$id)){ ?>
	<div class="thumb-wrap">
		<img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
		<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link($id).'">'.'edit</a>'; } ?>
	</div>
	<?php }else{ ?>
 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
 	<?php } ?>
 	<?php if($custom['body_style']!='' and $custom['body_style']=='game' ){ ?>
	
	<?php $score = get_post_meta($id, '_hotmagazine_score', true); $score_text = get_post_meta($id, '_hotmagazine_score_text', true); ?>
		<?php if($score!=''){ ?>
		<div class="rate-level">
			<p><span><?php echo esc_html($score); ?></span> <?php echo esc_html($score_text); ?></p>
		</div>
	<?php } ?>
	<?php }else{ ?>
 	<?php 
		$category_detail=get_the_category($id);//$post->ID
		foreach($category_detail as $cd){ ?>
		<a class="category-post" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a>
	<?php } ?>
	
	<?php } ?>
	</div>
	<div class="post-title">
		<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
		<ul class="post-tags">
			<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
			<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
			<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
		</ul>
	</div>
	<div class="post-content">
		<?php 
			$post = get_post( $id );

			$excerpt =  $post->post_excerpt;

			echo wp_kses_post($excerpt);
		?>
	</div>
</div>
<?php } ?>