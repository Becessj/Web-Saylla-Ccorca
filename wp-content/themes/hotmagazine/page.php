<?php get_header(); ?>

		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 content-blocker">

						<!-- block content -->
						<div class="block-content">
							<div class="title-section">
							  <h1><span><?php if(function_exists('is_bbpress')){ if(is_bbpress()){ echo "Forum"; }else{ single_post_title(); } }else{ single_post_title(); } ?></span></h1>
							</div>
							<div class="single-post-box">
							<?php while (have_posts()) : the_post(); ?>
								<?php the_content(); ?>
								
								<?php if('open' == $post->comment_status){ ?>

									<?php comments_template(); ?>

								<?php } ?>

							<?php endwhile; ?>
							</div>
							
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