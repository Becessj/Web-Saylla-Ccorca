<?php

/**
 * Single Topic Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="forum-box">
	<?php bbp_breadcrumb(); ?>
	<?php bbp_topic_tag_list(); ?>

		<?php bbp_single_topic_description(); ?>
<div class="forum-table single-topic">
	<div class="table-title">
	  <h2><?php echo single_post_title(); ?></h2>
	</div>
	<p class="posted-in-category">Posted In: <a href="<?php bbp_forum_permalink(); ?>"><?php echo bbp_get_forum_title(); ?></a></p>

	

	<?php do_action( 'bbp_template_before_single_topic' ); ?>

	<?php if ( post_password_required() ) : ?>

		<?php bbp_get_template_part( 'form', 'protected' ); ?>

	<?php else : ?>

		

		<?php if ( bbp_show_lead_topic() ) : ?>

			<?php bbp_get_template_part( 'content', 'single-topic-lead' ); ?>

		<?php endif; ?>

		<?php if ( bbp_has_replies() ) : ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

			<?php bbp_get_template_part( 'loop',       'replies' ); ?>

			<?php bbp_get_template_part( 'pagination', 'replies' ); ?>

		<?php endif; ?>

		<?php bbp_get_template_part( 'form', 'reply' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_single_topic' ); ?>
</div>
</div>
