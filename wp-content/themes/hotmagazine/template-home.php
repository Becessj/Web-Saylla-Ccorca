<?php 
/*
*Template Name: Home Builder
*/
?>
<?php get_header(); ?>
<?php $custom  = hotmagazine_custom(); ?>
<?php if($custom['body_style']!='' and $custom['body_style']=='design' ){ ?>
	<?php 
		if(is_front_page()){

		$args = array(
			'post_type' => 'post',
			'posts_per_page' =>-1,
		    'meta_query' => array(
						array(
							'key'     => '_hotmagazine_top',
							'value'   => 'on',
							'compare' => 'IN',
						),
			)
		);
		
		$top = new WP_Query($args);

	?>
	<?php if($top->found_posts>=1){ ?>
	<!-- heading-news-section
			================================================== -->
		<section class="heading-news3">

			<div class="heading-news-box">

				<div class="owl-wrapper">
					<div class="owl-carousel" data-num="4" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">

						<?php 
					      if($top->have_posts()) :
					             $i=0; while($top->have_posts()) : $top->the_post(); 
					    ?>

						<div class="item">
							<div class="news-post image-post">
								<?php the_post_thumbnail(); ?>
								<div class="hover-box">
									<div class="inner-hover">
										<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
										<ul class="post-tags">
											<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
											<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
											<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
										</ul>
										<?php the_excerpt(); ?>
									</div>
								</div>
							</div>
						</div>

						<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>

					</div>
				</div>

			</div>

		</section>
		<!-- End heading-news-section -->
		<?php } }?>
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
		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">

			<?php get_sidebar('small'); ?>

			<?php get_sidebar(); ?>

			<!-- block content -->
			<div class="block-content">

				<div class="container-fluid">

					<?php 
						while(have_posts()) : the_post(); 

							the_content();

						endwhile;
					?>

				</div>

			</div>
			<!-- End block content -->

		</section>
		<!-- End block-wrapper-section -->

<?php }else{ ?>
	<?php 
		while(have_posts()) : the_post(); 

			the_content();
			
		endwhile;
	?>
<?php } ?>

<?php get_footer(); ?>