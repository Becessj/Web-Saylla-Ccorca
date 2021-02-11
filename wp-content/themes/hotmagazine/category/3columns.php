<?php $custom  = hotmagazine_custom(); ?>
<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">

				<!-- block content -->
				<div class="block-content non-sidebar both-sidebar">

					<!-- grid box -->
					<div class="grid-box">
						<div class="title-section">
							<h1><span class="world"><?php single_cat_title( '', true ); ?></span></h1>
						</div>
						<div class="masonry-box">
						<div class="latest-articles iso-call">
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
							 

							<?php get_template_part( 'posts/grid3', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

							
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
					  </div>

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
		</section>
		<!-- End block-wrapper-section -->