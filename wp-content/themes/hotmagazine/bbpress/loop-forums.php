<?php

/**
 * Forums Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_forums_loop' ); ?>

<div class="forum-box">
	<div class="forum-table">
		<div class="table-head">
		  <div class="first-col"><a href="#">Forum</a></div>
		  <div class="second-col"><span>TOPICS / POSTS</span></div>
		  <div class="third-col"><span>Freshness</span></div>
		</div>
	
		<?php while ( bbp_forums() ) : bbp_the_forum(); ?>

			<?php bbp_get_template_part( 'loop', 'single-forum' ); ?>

		<?php endwhile; ?>

	

	</div>

</div><!-- .forums-directory -->

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
