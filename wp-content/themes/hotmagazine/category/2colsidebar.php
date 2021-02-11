<?php $custom  = hotmagazine_custom(); ?>
<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 content-blocker">

						<!-- block content -->
						<div class="block-content both-sidebar">

							<!-- grid box -->
							<div class="grid-box">
								<?php if(is_category()){ ?>
								<div class="title-section">
									<h1><span class="world"><?php single_cat_title( '', true ); ?></span></h1>
								</div>
								<?php }elseif (is_search()) { ?>
									<div class="title-section">
									<h1><span class="world">Search Result for "<?php echo esc_attr( get_search_query() ); ?>"</span></h1>
								</div>
								<?php } ?>

								<?php

								 $category_id = get_query_var( 'cat' );

							    if(is_front_page()) {
									$paged = (get_query_var('page')) ? get_query_var('page') : 1;
								} else {
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								}
								$args = array(
									'post_type' => 'post',
									'cat' => $category_id, 
									'posts_per_page' =>12,
									'paged' => $paged,
								);
								$query = new WP_Query($args);

							    
								$i=1; if(have_posts()) :
										while(have_posts()) : the_post(); 
								?>
								<?php if($i==7){ ?>
										<?php echo do_shortcode($custom['adv-editor']); ?>

								<?php }?>
								 <?php if($i%2==1 or $i==1){ ?>
					                <div class="row">
					            <?php } ?>  

								<?php get_template_part( 'posts/grid1', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

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
							</div>
							<!-- End grid box -->

							


							<!-- pagination box -->
							<div class="pagination-box">
								<?php hotmagazine_pagination($prev = esc_html__('Prev', 'hotmagazine'), $next = esc_html__('Next', 'hotmagazine'), $pages=''); ?>
							</div>
							<!-- End Pagination box -->

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