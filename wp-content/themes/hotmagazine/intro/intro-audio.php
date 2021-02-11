 <?php 
    $video = get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true);
?>
<?php if($video!=''){ ?>
<div class="post-gallery">
	<?php echo wp_oembed_get(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)); ?>
	<?php if(is_single()){ ?>
	<?php $caption = get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?>
	<?php if($caption!=''){ ?>
	<span class="image-caption"><?php echo esc_html($caption);?></span>
	<?php } ?>
	<?php } ?>
</div>
<?php } ?>