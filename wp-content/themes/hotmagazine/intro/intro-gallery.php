 <?php 
    $gallery = get_post_meta(get_the_ID(), '_hotmagazine_gallery', true);
?>
<?php if(count($gallery)>0 and $gallery!=''){ ?>
<div class="post-gallery">
	<ul class="bxslider">
		<?php foreach($gallery as $img) {?>
		<li><img src="<?php echo esc_attr($img); ?>" alt="<?php the_title(); ?>" class="img-responsive"/></li>
		<?php } ?>
	</ul>
	<?php if(is_single()){ ?>
	<?php $caption = get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?>
	<?php if($caption!=''){ ?>
	<span class="image-caption"><?php echo esc_html($caption);?></span>
	<?php } ?>
	<?php } ?>
</div>
<?php } ?>