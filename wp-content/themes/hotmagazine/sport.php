<?php $custom  = hotmagazine_custom(); ?>
<!-- Header
    ================================================== -->
<header class="clearfix">
	<!-- Bootstrap navbar -->
	<nav class="navbar navbar-default navbar-static-top" >
		<?php if($custom['topline']==true){  ?>
		<!-- Top line -->
		<div class="top-line">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<?php $city= $custom['city'];
						$city = $string = str_replace(' ', '', $city);
						$country = $custom['country']; ?>
						<?php if($city!=''){ ?>
							<ul class="top-line-list">
								<?php if($custom['weather']!=''){ ?>
									<li>
										<?php
										
										$url="http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$custom['weather'];
										$json=wp_remote_fopen($url);
										$data=json_decode($json,true);
										
										?>
										<span class="city-weather"><?php echo esc_html($city).', '.esc_html($country); ?></span>
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="24px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
											<path fill="#777777" d="M208,64c8.833,0,16-7.167,16-16V16c0-8.833-7.167-16-16-16s-16,7.167-16,16v32
												C192,56.833,199.167,64,208,64z M332.438,106.167l22.625-22.625c6.249-6.25,6.249-16.375,0-22.625
												c-6.25-6.25-16.375-6.25-22.625,0l-22.625,22.625c-6.25,6.25-6.25,16.375,0,22.625
												C316.062,112.417,326.188,112.417,332.438,106.167z M16,224h32c8.833,0,16-7.167,16-16s-7.167-16-16-16H16
												c-8.833,0-16,7.167-16,16S7.167,224,16,224z M352,208c0,8.833,7.167,16,16,16h32c8.833,0,16-7.167,16-16s-7.167-16-16-16h-32
												C359.167,192,352,199.167,352,208z M83.541,106.167c6.251,6.25,16.376,6.25,22.625,0c6.251-6.25,6.251-16.375,0-22.625
												L83.541,60.917c-6.25-6.25-16.374-6.25-22.625,0c-6.25,6.25-6.25,16.375,0,22.625L83.541,106.167z M400,256
												c-5.312,0-10.562,0.375-15.792,1.125c-16.771-22.875-39.124-40.333-64.458-51.5C318.459,145,268.938,96,208,96
												c-61.75,0-112,50.25-112,112c0,17.438,4.334,33.75,11.5,48.438C47.875,258.875,0,307.812,0,368c0,61.75,50.25,112,112,112
												c13.688,0,27.084-2.5,39.709-7.333C180.666,497.917,217.5,512,256,512c38.542,0,75.333-14.083,104.291-39.333
												C372.916,477.5,386.312,480,400,480c61.75,0,112-50.25,112-112S461.75,256,400,256z M208,128c39.812,0,72.562,29.167,78.708,67.25
												c-10.021-2-20.249-3.25-30.708-3.25c-45.938,0-88.5,19.812-118.375,53.25C131.688,234.083,128,221.542,128,208
												C128,163.812,163.812,128,208,128z M400,448c-17.125,0-32.916-5.5-45.938-14.667C330.584,461.625,295.624,480,256,480
												c-39.625,0-74.584-18.375-98.062-46.667C144.938,442.5,129.125,448,112,448c-44.188,0-80-35.812-80-80s35.812-80,80-80
												c7.75,0,15.062,1.458,22.125,3.541c2.812,0.792,5.667,1.417,8.312,2.521c4.375-8.562,9.875-16.396,15.979-23.75
												C181.792,242.188,216.562,224,256,224c10.125,0,19.834,1.458,29.25,3.709c10.562,2.499,20.542,6.291,29.834,11.291
												c23.291,12.375,42.416,31.542,54.457,55.063C378.938,290.188,389.209,288,400,288c44.188,0,80,35.812,80,80S444.188,448,400,448z"
											/>
										</svg>
										<span class="cel-temperature"><?php 
											
											$given_value =  round($data['main']['temp']-273.15); $fahrenheit=$given_value*9/5+32; 
											if($custom['weather_format']=='f'){
												echo $fahrenheit;
											}else{
												echo $given_value;
											}

										?></span>
									</li>
									<?php } ?>
								<li><span class="time-now"><?php 
									echo date_i18n( 'l d F Y / '.get_option( 'time_format' ), current_time( 'timestamp', 0 ) );
								?></span></li>
								
							</ul>
							<?php } ?>
							<?php 
					
								$defaults2= array(
									'theme_location'  => 'top',
									'menu'            => '',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'top-line-list top-menu',
									'menu_id'         => '',
									'echo'            => true,
									 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
									 
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
								);
								if ( has_nav_menu( 'top' ) ) {
									wp_nav_menu( $defaults2 );
								}
							
							?>
					</div>	
					<div class="col-md-3">
						<ul class="social-icons">
							<?php if($custom['facebook']!=''){ ?>
							  <li class="facebook"><a  href="<?php echo esc_url($custom['facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
							  <?php } ?>
							  <?php if($custom['twitter']!=''){ ?>
							  <li class="twitter"><a href="<?php echo esc_url($custom['twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
							  <?php } ?>
							 <?php if($custom['istagram']!=''){ ?>
								<li class="instagram"><a href="<?php echo esc_url($custom['istagram']); ?>"><i class="fa fa-instagram"> </i></a></li>
								<?php } ?>
							  <?php if($custom['google']!=''){ ?>
							  <li class="google"><a  href="<?php echo esc_url($custom['google']); ?>"><i class="fa fa-google-plus"></i></a></li>
							  <?php } ?>
							  <?php if($custom['linkedin']!=''){ ?>
							  <li class="linkedin"><a  href="<?php echo esc_url($custom['linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li>
							  <?php } ?>
							  <?php if($custom['pinterest']!=''){ ?>
							  <li class="pinterest" ><a href="<?php echo esc_url($custom['pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li>
							  <?php } ?>
						</ul>
					</div>	
				</div>
			</div>
		</div>
		<!-- End Top line -->
		<?php } ?>
		<!-- list line posts -->
		<div class="list-line-posts">
			<div class="container">

				<div class="owl-wrapper">
					<div class="owl-carousel" data-num="4" data-rtl="<?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>">

						<?php 

							if ( get_query_var('paged') ) {
							    $paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
							    $paged = get_query_var('page');
							} else {
							    $paged = 1;
							}
							$args = array(
								'post_type' => 'post',
								'posts_per_page' =>5,
							    'paged' => $paged,
							    'meta_query' => array(
													array(
														'key'     => '_hotmagazine_top',
														'value'   => 'on',
														'compare' => 'IN',
													),
										)
							);
							
							$portfolio = new WP_Query($args);

						?>
						<?php 
					      if($portfolio->have_posts()) :
					             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
					    ?>

						<div class="item list-post">
							<?php the_post_thumbnail('thumbanil'); ?>
							<div class="post-content">
								<?php the_category(', '); ?>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
								</ul>
							</div>
						</div>

						<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>

					</div>
				</div>

			</div>
		</div>
		<!-- End list line posts -->

		<!-- navbar list container -->
		<div class="nav-list-container">
			<div class="container">

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
					<?php 
						
						$defaults1= array(
							'theme_location'  => 'primary',
							'menu'            => '',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'nav navbar-nav navbar-left',
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