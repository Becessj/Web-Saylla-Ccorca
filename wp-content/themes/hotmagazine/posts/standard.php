<div <?php post_class('news-post large-post'); ?>>
<?php get_template_part( 'intro/intro', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
<div class="post-title">
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
	<ul class="post-tags">
		<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
		<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
		<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
	</ul>
</div>
<div class="post-content">
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
</div>
</div>