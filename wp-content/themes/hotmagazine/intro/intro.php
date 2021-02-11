<?php $custom  = hotmagazine_custom(); ?>
<?php if($custom['blog_thumbnail']!=false){ ?>
<?php if(has_post_thumbnail()){ ?>
<div class="post-gallery">
	<?php the_post_thumbnail(); ?>
	<?php if(is_single()){ ?>
	<?php $caption = get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?>
	<?php if($caption!=''){ ?>
	<span class="image-caption"><?php echo esc_html($caption);?></span>
	<?php } ?>
	<?php } ?>
</div>
<?php } ?>
<?php } ?>