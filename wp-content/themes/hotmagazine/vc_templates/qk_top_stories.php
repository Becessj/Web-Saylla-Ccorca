<?php
extract(shortcode_atts(array(
	'tag'=>'',
	'order'=>'',
	'cat'=>'',
), $atts));

?>
<div class="image-slider snd-size">
	<span class="top-stories"><?php echo esc_html($tag); ?></span>
	<?php if($order>1){ ?>
	<ul class="bxslider">
	<?php } ?>
		<?php 
		
				$arr = array('post_type' => 'post', 'posts_per_page' => $order,'meta_query' => array(
						array(
							'key'     => '_hotmagazine_stories',
							'value'   => 'on',
							'compare' => 'IN',
						),
			));
				if($cat!='all'){
				  if ( is_rtl() ) {
				  	$arr['cat'] = $cat;
				  }else{
				  	$arr['category_name'] = $cat;
				  }
				}
				$query = new WP_Query($arr);
				while($query->have_posts()) : $query->the_post();
			?>
		<?php if($order>1){ ?>
		<li>
		<?php } ?>
			<div class="news-post image-post">
				<?php the_post_thumbnail('second'); ?>
				<div class="hover-box">
					<div class="inner-hover">
						<?php 
						$category_detail=get_the_category();//$post->ID
						foreach($category_detail as $cd){ ?>
						<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
						<?php } ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
							<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
							<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						</ul>
						<?php if(get_post_meta(get_the_ID(), '_hotmagazine_caption', true)!=''){ ?>
						<p> <?php echo get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php if($order>1){ ?>
		</li>
		<?php } ?>
		<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	<?php if($order>1){ ?>
	</ul>
	<?php } ?>
</div>