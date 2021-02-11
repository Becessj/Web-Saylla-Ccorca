<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="table-row">
<div class="forum-post comment-post">
<div <?php bbp_reply_class(); ?>>
<?php 
	$author_id = get_the_author_meta('ID') ;
	$authord = get_userdata( $author_id );
	$author_email = $authord->user_email;
?>
<?php if(get_user_meta($author_id, '_hotmagazine_avatar' ,true)!=''){ ?>
<img src="<?php echo get_user_meta($author_id, '_hotmagazine_avatar' ,true); ?>" />
<?php }else{ ?>
<?php 
   echo get_avatar($author_email,$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=120' );
?>
<?php } ?>
<div class="post-autor-date">
 <p> <?php bbp_reply_admin_links(); ?></p>
 <p>by: <?php bbp_reply_author_link( array( 'sep' => '<br />',  'show_role' => false, 'type' => 'name' ) ); ?></p>
 <p><span class="date">ON <?php bbp_reply_post_date(); ?></span></p>
 <div class="content-post-area">
 	<?php bbp_reply_content(); ?>
 </div>

</div>
</div>
</div>
</div>

