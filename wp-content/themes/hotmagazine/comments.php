
<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<!-- comment area box -->
<div class="comment-area-box">
	<div class="title-section">
		<h1><span><?php comments_number( __('0 Comments','hotmagazine'), __('1 Comment','hotmagazine'), __('% Comments','hotmagazine') ); ?></span></h1>
	</div>
	<ul class="comment-tree">
		<?php 
			$args = array(
				'walker'            => null,
				'max_depth'         => '',
				'style'             => 'ul',
				'callback'          => 'hotmagazine_theme_comment',
				'end-callback'      => null,
				'type'              => 'all',
				'reply_text'        => 'Reply',
				'page'              => '',
				'per_page'          => '',
				'avatar_size'       => 80,
				'reverse_top_level' => null,
				'reverse_children'  => '',
				'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
				'short_ping'        => false,   // @since 3.6
				'echo'              => true     // boolean, default is true
			); 
		?>
		<?php wp_list_comments($args); ?>
	</ul>
	<?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<footer class="navigation comment-navigation" role="navigation">
		  <div class="previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'hotmagazine' ) ); ?></div>
		  <div class="next right"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'hotmagazine' ) ); ?></div>
		</footer><!-- .comment-navigation -->
	  <?php endif; // Check for comment navigation ?>
</div>
<!-- End comment area box -->


<!-- contact form box -->
<div class="contact-form-box">
	
	<?php
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$comment_args = array(
		'title_reply'=> '<span>'.esc_html__('Leave a Comment','hotmagazine').'</span>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '
					<div class="row">
					<div class="col-md-4"><label for="name">'.esc_html__('Name','hotmagazine').'*</label>
					<input type="text" name="author"   id="name" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
					</div>
				
			',
			'email' => '<div class="col-md-4">
						<label for="mail">'.esc_html__('Email','hotmagazine').'*</label>
					<input id="mail" name="email"   type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></div>
					
				
			',
			'url' => '<div class="col-md-4"><label for="website">'.esc_html__('Webstie','hotmagazine').'</label>
				<input id="website" name="url"   type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  /></div>
				</div>
			'
		)),
		'comment_field' => '<label for="comment">'.esc_html__('Comment','hotmagazine').'*</label><textarea    id="comment"   name="comment"'.$aria_req.'></textarea>',
		'label_submit' => esc_html__('Post Comment','hotmagazine'),
		'comment_notes_before' => '<span class="email-not-published">'.esc_html__('Your email address will not be published','hotmagazine').'.</span>',
		'comment_notes_after' => '',
	);
	?>
	  
	
	<?php if('open' == $post->comment_status){ ?>

		<?php comment_form($comment_args); ?>

	<?php } ?>

	
</div>
<!-- End contact form box -->
