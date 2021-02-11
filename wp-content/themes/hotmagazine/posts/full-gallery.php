<div class="news-post very-large-post">
	<div class="title-post">
		<?php 
			$id = get_the_ID();
			$category_detail=get_the_category($id);//$post->ID
			foreach($category_detail as $cd){ ?>
			<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
		<?php } ?>
		<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
		<ul class="post-tags">
			<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
			<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
			<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
			
		</ul>
	</div>
	 <?php 
	    $gallery = get_post_meta(get_the_ID(), '_hotmagazine_gallery', true);
	?>
	<?php if(count($gallery)>0 and $gallery!=''){ ?>
	<div class="post-gallery">
		<ul class="slider-call">
			<?php foreach($gallery as $img) {?>
			<li><img src="<?php echo esc_attr($img); ?>" alt="<?php the_title(); ?>" class="img-responsive"/></li>
			<?php } ?>
		</ul>
		<div id="bx-pager">
			<?php $i=0; foreach($gallery as $img) {?>
				<?php $img_id = hotmagazine_get_attachment_id_from_url( $img ); ?>
				<?php $img_url = wp_get_attachment_image_src($img_id,'thumbnail'); ?>
				<a data-slide-index="<?php echo esc_attr($i); ?>" href=""><img src="<?php echo esc_attr($img_url[0]); ?>" /></a>
			<?php $i++; } ?>
			
		</div>
	</div>
	<?php } ?>
	<div class="post-content">
		
		<?php the_content(); ?>
		<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
		<?php if($custom['share_top']==true){ ?>
		<div class="share-box">
			<a class="likes" href="#"><i class="fa fa-heart-o"></i> <span>0</span></a>

			<ul class="share-list-post">
				<li><i class="fa fa-share-alt"></i><span><?php esc_html_e('Share Post','hotmagazine');?></span></li>
				<li><a class="facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
				<li><a class="google" href="http://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a></li>
				<li><a class="twitter"  onclick="window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>"><i class="fa fa-twitter"></i></a></li>
				<li  class="pinterest"><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest"></i></a></li>
                <li class="linkedin"><a onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>"><i class="fa fa-linkedin"></i></a></li>
				
			</ul>
		</div>
		<?php } ?>
	</div>
</div>

<?php

  $post_id = get_the_ID();
  $tags = wp_get_post_tags($post_id);  

  if ($tags) {  
  $tag_ids = array();  
  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
  $args=array(  
  'tag__in' => $tag_ids,  
  'post__not_in' => array($post_id),  
  'posts_per_page'=>3, // Number of related posts to display.  
  'ignore_sticky_posts'=>1  
  );  
	
  $my_query = new wp_query( $args );
?>
<?php if($my_query->found_posts>0){ ?>
<div class="other-posts-box">
	<div class="title-section">
		<h1><span>You Might Also Like</span></h1>
	</div>

	<div class="row">

		<?php while( $my_query->have_posts() ) {  
			$my_query->the_post(); ?> 

		<div class="col-md-4">
			<div class="news-post standard-post2">
				<div class="post-gallery">
					<?php the_post_thumbnail(''); ?>
				</div>
				<div class="post-title">
					<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					</ul>
				</div>
			</div>
		</div>	

		<?php } ?>
		<?php 
		wp_reset_postdata();  
		?>
	</div>

</div>
<?php } } ?>