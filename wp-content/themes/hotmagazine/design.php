<?php $custom  = hotmagazine_custom(); ?>
<!-- Header
		    ================================================== -->
		<header class="clearfix third-style">
			<!-- Bootstrap navbar -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation">

				<!-- navbar list container -->
				<div class="nav-list-container">
					<div class="container-fluid">

						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand"  href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
								<?php if($custom['logo']['url']!=''){ ?>
									<img src="<?php echo esc_attr($custom['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
								  <?php }else{ ?>
									<?php bloginfo('name'); ?>
								  <?php } ?>
							</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							
							<?php if($custom['search']==true){  ?>

							<form method="get" class="navbar-form navbar-right" action="<?php echo esc_url( home_url('/') ); ?>" >
								<input type="text" name="s" placeholder="<?php esc_attr_e( 'Search here', 'hotmagazine' ); ?>" />
								<button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
							</form>

							<?php } ?>
							
							<?php 
						
								$defaults1= array(
									'theme_location'  => 'primary',
									'menu'            => '',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'nav navbar-nav navbar-right',
									'menu_id'         => '',
									'echo'            => true,
									 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									 'walker'            => new wp_bootstrap_navwalker(),
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
								);
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( $defaults1 );
								}
							
							?>
							

						</div>
						<!-- /.navbar-collapse -->
					</div>
				</div>
				<!-- End navbar list container -->

			</nav>
			<!-- End Bootstrap navbar -->

		</header>
		<!-- End Header -->