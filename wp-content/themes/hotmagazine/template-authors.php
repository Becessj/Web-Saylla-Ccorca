<?php 
/*
*Template Name: Author List
*/
?>
<?php get_header(); ?>
		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 content-blocker">

						<!-- block content -->
						<div class="block-content">

							<!-- grid box -->
							<div class="grid-box">
								<div class="title-section">
									<h1><span><?php single_post_title(); ?></span></h1>
								</div>
								<?php 
									while(have_posts()) : the_post(); 
									endwhile;
								?>
								<ul class="autor-list">
									<?php
									   $blogusers = get_users( 'orderby=post_count&who=authors' );
									     
									?>
									<?php foreach ( $blogusers as $curauth ) { ?>
									<li>

										<div class="autor-box">

											<?php if(get_user_meta($curauth->ID, '_hotmagazine_avatar' ,true)!=''){ ?>
											<img src="<?php echo get_user_meta($curauth->ID, '_hotmagazine_avatar' ,true); ?>" />
											<?php }else{ ?>
											<?php 
											   echo get_avatar($curauth->user_email,$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=120' );
											?>
											<?php } ?>

											<div class="autor-content">

												<div class="autor-title">
													<h1><span><?php echo esc_html($curauth->display_name); ?></span><a href="<?php echo get_author_posts_url( $curauth->ID); ?>"><?php echo count_user_posts( $curauth->ID , 'post' ); ?> <?php echo esc_html('Posts', 'magazine'); ?></a></h1>
													<ul class="autor-social">
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_facebook' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_facebook' ,true)); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_google' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_google' ,true)); ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_twitter' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_twitter' ,true)); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_youtube' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_youtube' ,true)); ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_instagram' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_instagram' ,true)); ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_linkedin' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_linkedin' ,true)); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
														<?php } ?>
														<?php if(get_user_meta($curauth->ID, '_hotmagazine_user_dribble' ,true)!=''){ ?>
														<li><a href="<?php echo esc_url(get_user_meta($curauth->ID, '_hotmagazine_user_dribble' ,true)); ?>" class="dribble"><i class="fa fa-dribbble"></i></a></li>
														<?php } ?>
													</ul>
												</div>

												<p>
													<?php echo esc_html(get_the_author_meta('description',$curauth->ID));?>
												</p>

											</div>

										</div>

										<div class="autor-last-line">
											<ul class="autor-tags">
												
												<?php 
													$cats = get_the_category();
  													 $postAuthor = $curauth->ID;
												?>
												<?php
												//get all posts for an author, then collect all categories
												//for those posts, then display those categories
												$cat_array = array();
												$args=array(
												 'author' => $postAuthor,
												 'showposts'=>-1,
												 
												);
												$author_posts = get_posts($args);
												if( $author_posts ) {
												  foreach ($author_posts as $author_post ) {
												    foreach(get_the_category($author_post->ID) as $category) {
												      $cat_array[$category->term_id] =  $category->term_id;
												    }
												  }
												}
												$cat_ids = implode(',', $cat_array);
												wp_list_categories('include='.$cat_ids.'&title_li=<li><span><i class="fa fa-bars"></i>Category</span></li>');
												?>
												
											</ul>
											<?php if($curauth->user_url!=''){ ?>
											<a href="<?php echo esc_url($curauth->user_url);?>" class="autor-site"><?php echo esc_html($curauth->user_url);?></a>
											<?php } ?>
										</div>

										
									</li>

									<?php } ?>

								</ul>
							</div>
							<!-- End grid box -->

						</div>
						<!-- End block content -->

					</div>

					<div class="col-sm-4 sidebar-sticky">

						<?php get_sidebar(); ?>

					</div>

				</div>

			</div>
		</section>
		<!-- End block-wrapper-section -->

<?php get_footer(); ?>