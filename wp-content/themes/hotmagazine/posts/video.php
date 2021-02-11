<div class="col-md-6">
	<div class="news-post video-post">
		<?php //the_category(); ?>
		<?php the_post_thumbnail(); ?>

		<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play-circle-o"></i></a>
		<div class="hover-box">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
			<ul class="post-tags">
				<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
			</ul>
		</div>
	</div>
</div>