<div class="news-post banner-quote-post" <?php if(has_post_thumbnail()){ ?> style="background-image: url(<?php echo hotmagazine_thumbnail_url($size='',$id=''); ?>);" <?php } ?>>
	<div class="quote">
		<?php the_content(); ?>
	</div>
</div>