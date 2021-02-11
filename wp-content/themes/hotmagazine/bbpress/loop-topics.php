<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div class="forum-box">

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<div class="forum-table">

		<div class="table-title">
		  <h2><?php echo bbp_get_forum_title(); ?></h2>
		  <p><?php bbp_forum_content(); ?></p>
		</div>

	

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	

</div>
<?php do_action( 'bbp_template_after_topics_loop' ); ?>
</div>