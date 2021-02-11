<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="table-row">
	
	  
	  
	
	<div class="first-col">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<h2><a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a></h2>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>

		<?php bbp_forum_content(); ?>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>

	</div>

	
	<div class="second-col">
	    <p><span><?php bbp_forum_topic_count(); ?></span> Topics</p>
	    <p><span><?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?></span> Posts</p>
	  </div>
	
	
	<div class="third-col">
		

		<div class="post-autor-date">

			<?php do_action( 'bbp_theme_before_topic_author' ); ?>

			<p>by <?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 40 ) ); ?></p>

			<?php do_action( 'bbp_theme_after_topic_author' ); ?>

			<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>

			<p class="freshness" ><?php bbp_forum_freshness_link(); ?></p>

			<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

		</div>
	  </div>
</div><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->
