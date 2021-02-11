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
									<h1><span><?php esc_html_e('Author Details','hotmagazine'); ?></span></h1>
								</div>
								
								<?php
								
								$curauth = $wp_query->get_queried_object();

								?>
								<ul class="autor-list">

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
													<h1><span><?php echo esc_html($curauth->display_name); ?></span><a href="#"><?php echo count_user_posts( $curauth->ID , 'post' ); ?> <?php echo esc_html('Posts', 'magazine'); ?></a></h1>
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

												
													<?php echo esc_html(get_the_author_meta('description'));?>
												

											</div>

										</div>

										<div class="autor-last-line">
											<ul class="autor-tags">
												
												<?php 
													$cats = get_the_category();
  													 $postAuthor = $wp_query->post->post_author;
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

								</ul>

								<?php $i=1; if(have_posts()) :
										while(have_posts()) : the_post(); 
								?>
								
								 <?php if($i%2==1 or $i==1){ ?>
					                <div class="row">
					            <?php } ?>  

								<div class="col-md-6">
									<div class="news-post image-post2">
										<div class="post-gallery">
											<?php if(has_post_thumbnail()){ ?>
											<?php the_post_thumbnail('thumbnail'); ?>
											<?php }else{ ?>
											<img src="http://placehold.it/270x200" />
											<?php } ?>
											<div class="hover-box">
												<div class="inner-hover">
													<?php 
														$category_detail=get_the_category($id);//$post->ID
														foreach($category_detail as $cd){ ?>
														<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
													<?php } ?>
													<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
													<ul class="post-tags">
														<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
														<li><?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="post-content">
											<p><?php echo  hotmagazine_excerpt($limit = 20); ?></p>
											<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
										</div>
									</div>
								</div>

								<?php if($i%2==0 or $i == $wp_query->post_count){ ?>    
					              </div>
					            <?php } ?>
								<?php $i++; endwhile; ?>
								<?php else: ?>
								<div class="not-found">
									<h1><?php esc_html_e('Nothing Found Here!','hotmagazine'); ?></h1>
									<h3><?php esc_html_e('Search with other string:', 'hotmagazine') ?></h3>
									<div class="search-form">
										<?php get_search_form(); ?>
									</div>
								</div>
								<?php endif; ?>
								<?php wp_reset_postdata(); ?>	

								<!-- pagination box -->
								<div class="pagination-box">
									<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
								</div>
								<!-- End Pagination box -->

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