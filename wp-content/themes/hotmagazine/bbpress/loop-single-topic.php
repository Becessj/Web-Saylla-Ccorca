<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="table-row">

	<div class="forum-post">

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_topic_favorite_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-row-actions">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_topic_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>
		<?php 
			$author_id = get_the_author_meta('ID') ;
			$authord = get_userdata( $author_id );
			$author_email = $authord->user_email;
		?>
		<?php if(get_user_meta($author_id, '_hotmagazine_avatar' ,true)!=''){ ?>
		<img src="<?php echo get_user_meta($author_id, '_hotmagazine_avatar' ,true); ?>" />
		<?php }else{ ?>
		<?php 
		   echo get_avatar($author_email,$size='40',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=120' );
		?>
		<?php } ?>
		<div class="post-autor-date">
			<?php do_action( 'bbp_theme_before_topic_title' ); ?>

			<h2><a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></h2>

			<?php do_action( 'bbp_theme_after_topic_title' ); ?>

			<?php bbp_topic_pagination(); ?>

			<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

			<p >

				<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>
				<?php esc_html_e('Started by','hotmagazine');   ?> <a href="<?php echo bbp_get_user_profile_url( $author_id );?>"><?php  echo esc_html($authord->display_name); ?></a>
				

				<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

				<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>

					<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

					<span class="bbp-topic-started-in"><?php printf( wp_kses_post( 'in: <a href="%1$s">%2$s</a>'), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>

					<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

				<?php endif; ?>

			</p>

			<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

			<?php bbp_topic_row_actions(); ?>

			

			<p>
				<?php esc_html_e('Last Post','hotmagazine'); ?>: <?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'type' => 'name' ) ); ?> - 
				<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>
				<strong class="freshness">
				<?php bbp_topic_freshness_link(); ?>
				</strong>
				<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
				
					<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

				

				<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

			</p>
		</div>
	</div>
	<div class="forum-topics">
	  <p><span><?php bbp_topic_voice_count(); ?></span> Voices</p>
	  <p><span><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></span> Posts</p>
	</div>
	

</div><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
