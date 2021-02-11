

	<div class="news-post standard-post2 default-size">
	    <div class="post-gallery">
	      <?php if(has_post_thumbnail()){ ?>
			<?php the_post_thumbnail('medium'); ?>
			<?php }else{ ?>
			<img src="http://placehold.it/270x200" />
			<?php } ?>
	     <?php 
			$category_detail=get_the_category($id);//$post->ID
			foreach($category_detail as $cd){ ?>
			<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
		<?php } ?>
	    </div>
	    <div class="post-title">
	      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
			<ul class="post-tags">
				<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
				<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
				<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
			</ul>
	    </div>
	    <div class="post-content">
	      <?php echo  the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
	    </div>
	  </div>
