<?php $custom  = hotmagazine_custom(); ?>
		<?php 

		$args = array(
			'post_type' => 'post',
			'posts_per_page' =>-1,
		    'meta_query' => array(
						array(
							'key'     => '_hotmagazine_featured',
							'value'   => 'on',
							'compare' => 'IN',
						),
			)
		);
		
		$portfolio = new WP_Query($args);

		?>
		<?php if($portfolio->found_posts>=1){ ?>
		<!-- photo-line-section
			================================================== -->
		<section class="photo-line-section">

			<div class="owl-wrapper">
				<div class="owl-carousel" data-num="5" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">

					<?php 
				      if($portfolio->have_posts()) :
				             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
				    ?>
					

					<div class="item">
						<div class="news-post image-post4">
							<?php the_post_thumbnail(); ?>
							<?php 
							$category_detail=get_the_category($id);//$post->ID
							foreach($category_detail as $cd){ ?>
							<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
							<?php } ?>
							<div class="hover-box">
								<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
									<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
								</ul>
							</div>
						</div>
					</div>

					<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
					

				</div>
			</div>
		</section>
		<!-- End photo-line-section -->
		<?php } ?>

		<!-- single-post-wide-slider
			================================================== -->
		<section class="single-wide">
			<?php 
			    $gallery = get_post_meta(get_the_ID(), '_hotmagazine_gallery', true);
			?>
			<?php if(count($gallery)>0 and $gallery!=''){ ?>
			<div class="image-slider">
				<ul class="bxslider">
					<?php foreach($gallery as $img) {?>
					<li>
						<div class="news-post image-post">
							<img src="<?php echo esc_attr($img); ?>" alt="<?php the_title(); ?>" class="img-responsive"/>
							<div class="hover-box">
								<div class="inner-hover">
									<div class="container">
										<h1><?php the_title(); ?></h1>
										<ul class="post-tags">
											<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
											<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
											<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
											
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php }?>
		</section>
		<!-- End single-post-wide-slider -->

		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">

			<?php get_sidebar('small'); ?>

			<?php get_sidebar(); ?>

			<!-- block content -->
			<div class="block-content">

				<div class="container-fluid">

					<!-- single-post box -->
					<div class="single-post-box wide-version">
						<?php if($custom['share_top']==true){ ?>
						<div class="share-post-box">
							<ul class="share-box">
								<li><i class="fa fa-share-alt"></i><span><?php esc_html_e('Share Post','hotmagazine');?></span></li>
								<li><a class="facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i><span><?php esc_html_e('Share on Facebook','hotmagazine'); ?></span></a></li>
										<li><a class="twitter" onclick="window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>"><i class="fa fa-twitter"></i><span><?php esc_html_e('Share on Twitter','hotmagazine'); ?></span></a></li>
								<li><a class="google" href="http://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i><span></span></a></li>
								<li><a class="linkedin" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>"><i class="fa fa-linkedin"></i><span></span></a></li>
							</ul>
						</div>
						<?php } ?>
						<?php if(count($gallery)>0 and $gallery!=''){ ?>
							
							<?php }else{ ?>
							<?php get_template_part( 'intro/intro', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
							<?php } ?>
						<?php the_content(); ?>
						<?php
	                        $defaults = array(
	                          'before'           => '<div id="page-links"><strong>Page: </strong>',
	                          'after'            => '</div>',
	                          'link_before'      => '<span>',
	                          'link_after'       => '</span>',
	                          'next_or_number'   => 'number',
	                          'separator'        => ' ',
	                          'nextpagelink'     => esc_html__( 'Next page','hotmagazine' ),
	                          'previouspagelink' => esc_html__( 'Previous page','hotmagazine' ),
	                          'pagelink'         => '%',
	                          'echo'             => 1
	                        );
	                       ?>
	                      <?php wp_link_pages($defaults); ?>
	                      <?php 
									$reviews = get_post_meta(get_the_ID(),'post_review', true); 
									$review_d = get_post_meta(get_the_ID(),'_hotmagazine_review_dsc', true); 
									
									if(isset($reviews[0]['_hotmagazine_review_title'])){ ?>
										<div class="review-box">
										<div class="title-section">
											<h1><span><?php esc_html_e('Reviewer overview','hotmagazine'); ?></span></h1>
										</div>
										<div class="member-skills">

										<?php $total = 0;  $i=0;foreach((array)$reviews as $key => $entry){
												
												 $title = esc_html( $entry['_hotmagazine_review_title'] );
												 $score = $entry['_hotmagazine_review_core']; 
												 $percent = $entry['_hotmagazine_review_core']*10; 
												 $total = $total + $score;
												?>
												<p><?php echo esc_html( $entry['_hotmagazine_review_title'] ); ?> - <?php echo esc_html( $score ); ?>/10</p>
												<div class="meter nostrips design">
													<p style="width: <?php echo esc_attr($percent); ?>%"></p>
												</div>

											<?php $i++; } ?>
										</div>
										<div class="summary-box">
											<h2><?php esc_html_e('Summary','hotmagazine'); ?></h2>
											<p><?php echo esc_html($review_d); ?></p>
											<div class="summary-degree">
												<p><span><?php $tscore = round($total/$i,1); echo esc_html($tscore); ?></span>
												<?php 
													if($tscore>=9){
														$text = esc_html__('Amazing','hotmagazine');
													}elseif($tscore>=8){

														$text = esc_html__('Excellent','hotmagazine');
													}elseif($tscore>=7){

														$text = esc_html__('Good','hotmagazine');
													}elseif($tscore>=6){

														$text = esc_html__('Okay','hotmagazine');
													}elseif($tscore>=5){

														$text = esc_html__('Mediocre','hotmagazine');
													}else{
														$text = esc_html__('Bad','hotmagazine');
													}
												?>
												<?php echo esc_html($text); ?>!</p>
											</div>
										</div>
									</div>
									<?php 	}
									?>
						<?php if(has_tag()){ ?>
						<div class="post-tags-box">
							<?php the_tags('<ul class="tags-box"><li><i class="fa fa-tags"></i><span>Tags:</span> </li><li>',' </li> <li>','</li></ul>'); ?>
							
						</div>
						<?php } ?>
						<?php if($custom['share_bottom']==true){ ?>
						<div class="share-post-box">
							<ul class="share-box">
								<li><i class="fa fa-share-alt"></i><span><?php esc_html_e('Share Post','hotmagazine');?></span></li>
								<li><a class="facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i><span><?php esc_html_e('Share on Facebook','hotmagazine'); ?></span></a></li>
								<li><a class="twitter" onclick="window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo str_replace(" ","%20",get_the_title()); ?>"><i class="fa fa-twitter"></i><span><?php esc_html_e('Share on Twitter','hotmagazine'); ?></span></a></li>
								<li><a class="google" href="http://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i><span></span></a></li>
								<li><a class="linkedin" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>"><i class="fa fa-linkedin"></i><span></span></a></li>
							</ul>
						</div>
						<?php } ?>
						<?php

			                $prev_post = get_adjacent_post(false, '', true);
			              
			                $next_post = get_adjacent_post(false, '', false); 

			            ?>
						<div class="prev-next-posts">
							 <?php if($prev_post!=null){ ?>
							<div class="prev-post">
								<?php if(has_post_thumbnail($id=$prev_post->ID)){ ?>
								<img src="<?php echo hotmagazine_thumbnail_url('thumbnail', $id=$prev_post->ID); ?>" alt="">
								<?php }else{ ?>
					    	 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/70x70"  class="img-responsive" > 
					    	 	<?php } ?>
								<div class="post-content">
									<h2><a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" title="prev post"><?php echo esc_html($prev_post->post_title); ?> </a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i><?php echo get_the_time(get_option( 'date_format' ), $prev_post->ID); ?></li>
										<li><a href="#"><i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $prev_post->ID );?></span></a></li>
									</ul>
								</div>
							</div>
							<?php } ?>
							<?php if($next_post!=null){ ?>
							<div class="next-post">
								<?php if(hotmagazine_thumbnail_url($size='thumbnail', $id=$next_post->ID)!=''){ ?>
								<img src="<?php echo hotmagazine_thumbnail_url($size='thumbnail', $id=$next_post->ID); ?>" alt="">
								<?php }else{ ?>
					    	 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/70x70"  class="img-responsive" > 
					    	 	<?php } ?>
								<div class="post-content">
									<h2><a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="prev post"><?php echo esc_html($next_post->post_title); ?> </a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i><?php echo get_the_time(get_option( 'date_format' ), $next_post->ID); ?></li>
										<li><a href="#"><i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $next_post->ID );?></span></a></li>
									</ul>
								</div>
							</div>
							<?php } ?>
						</div>

						<?php if($custom['blog_author']==true){ ?>
							<div class="about-more-autor">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#about-autor" data-toggle="tab"><?php esc_html_e('About The Author','hotmagazine'); ?></a>
									</li>
									<li>
										<a href="#more-autor" data-toggle="tab"><?php esc_html_e('More From The Author','hotmagazine'); ?></a>
									</li>
								</ul>

								<div class="tab-content">

									<div class="tab-pane active" id="about-autor">
										<div class="autor-box">
											<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_avatar' ,true)!=''){ ?>
											<img src="<?php echo get_user_meta(get_the_author_meta('ID'), '_hotmagazine_avatar' ,true); ?>" />
											<?php }else{ ?>
											<?php 
											   echo get_avatar(get_the_author_meta('user_email'),$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=120' );
											?>
											<?php } ?>
											<div class="autor-content">
												<div class="autor-title">
													<h1><span><?php echo esc_html(get_the_author_meta('display_name'));?></span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo count_user_posts( get_the_author_meta('ID') , 'post' ); ?> <?php echo esc_html('Posts', 'magazine'); ?></a></h1>
													<ul class="autor-social">
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_facebook' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_facebook' ,true)); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_google' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_google' ,true)); ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_twitter' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_twitter' ,true)); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_youtube' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_youtube' ,true)); ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_instagram' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_instagram' ,true)); ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_linkedin' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_linkedin' ,true)); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_dribble' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_hotmagazine_user_dribble' ,true)); ?>" class="dribble"><i class="fa fa-dribbble"></i></a></li>
														<?php } ?>
													</ul>
												</div>
												
													<?php echo esc_html(get_the_author_meta('description'));?>
												
											</div>
										</div>
									</div>

									<div class="tab-pane" id="more-autor">
										<div class="more-autor-posts">

											<?php 
												$post_id = get_the_ID();
												$a_id = get_the_author_meta('ID');
												$author = new WP_Query( array( 'author' => $a_id, 'post_type'=>'post', 'posts_per_page'=>'4','post__not_in' => array($post_id),  ) );

											?>
											<?php while($author->have_posts()) : $author-> the_post(); ?>
											<div class="news-post image-post3">
												<?php the_post_thumbnail('thumbnail'); ?>
												<div class="hover-box">
													<h2><a href="<?php the_permalink(); ?>"><?php the_title();?> </a></h2>
													<ul class="post-tags">
														<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
													</ul>
												</div>
											</div>
										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
										</div>
									</div>

								</div>
							</div>
							<?php } ?>

						<?php if($custom['related_post']==true){ ?>
							<?php
							  
							  $post_id = get_the_ID();
							  $tags = wp_get_post_tags($post_id);  
							
							  if ($tags) {  
							  $tag_ids = array();  
							  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
							  $args=array(  
							  'tag__in' => $tag_ids,  
							  'post__not_in' => array($post_id),  
							  'posts_per_page'=>5, // Number of related posts to display.  
							  'ignore_sticky_posts'=>1  
							  );  
								
							  $my_query = new wp_query( $args );
						    ?>
						    	<!-- carousel box -->
								<div class="carousel-box owl-wrapper">
								<div class="title-section">
									<h1><span><?php esc_html_e('You may also like','hotmagazine'); ?></span></h1>
								</div>
								<div class="owl-carousel" data-num="3" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">

									<?php while( $my_query->have_posts() ) {  
										$my_query->the_post(); ?> 

									<div class="item news-post image-post3">
										<?php the_post_thumbnail('thumbnail'); ?>
										<div class="hover-box">
											<h2><a href="<?php the_permalink(); ?>"><?php the_title();?> </a></h2>
											<ul class="post-tags">
												<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
											</ul>
										</div>
									</div>
									<?php } ?>
									<?php 
									wp_reset_postdata();  
									?>
								</div>
								</div>

							<!-- End carousel box -->
							<?php } ?>
							<?php } ?>

							<?php if('open' == $post->comment_status){ ?>
								<?php comments_template(); ?>
								
								<?php } ?>

					</div>
					<!-- End single-post box -->
				</div>

			</div>
			<!-- End block content -->

		</section>
		<!-- End block-wrapper-section -->

