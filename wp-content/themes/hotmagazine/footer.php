<?php $custom  = hotmagazine_custom(); ?>
		<!-- footer 
			================================================== -->
		<footer>
			<div class="container">
				<?php if($custom['footer-widgets']=='yes'){ ?>
				<div class="footer-widgets-part">
					<div class="row">
						<?php 
							$widget = 0;
							if(is_active_sidebar('footer-1')){
								$widget = $widget+1;
							}
							if(is_active_sidebar('footer-2')){
								$widget = $widget+1;
							}
							if(is_active_sidebar('footer-3')){
								$widget = $widget+1;
							}
							if(is_active_sidebar('footer-4')){
								$widget = $widget+1;
							}
							if($widget==0){
								$widget=1;
							}
							$col = 12/$widget;
						?>
						<div class="col-md-<?php echo esc_attr($col); ?>">
							<?php 
								dynamic_sidebar('footer-1');
							?>
							
						</div>
						<div class="col-md-<?php echo esc_attr($col); ?>">
							<?php 
								dynamic_sidebar('footer-2');
							?>
						</div>
						<div class="col-md-<?php echo esc_attr($col); ?>">
							<?php 
								dynamic_sidebar('footer-3');
							?>
						</div>
						<div class="col-md-<?php echo esc_attr($col); ?>">
							<?php 
								dynamic_sidebar('footer-4');
							?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="footer-last-line">
					<div class="row">
						<div class="col-md-6">
							<p><?php echo wp_kses_post($custom['footer-text']); ?></p>
						</div>
						<div class="col-md-6">
							<nav class="footer-nav">
								<?php 
						
									$defaults1= array(
										'theme_location'  => 'footer',
										'menu'            => '',
										'container'       => '',
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'footer-menu',
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
									if ( has_nav_menu( 'footer' ) ) {
										wp_nav_menu( $defaults1 );
									}
								
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End footer -->

	</div>
	<!-- End Container -->

	<!-- Contents of log in popup-->
	<div id="log-in-popup" class="mfp-hide white-popup">
		<?php if(!is_user_logged_in()) { ?>
		<form class="login-form" method="post" name="loginform" action="<?php echo esc_url(home_url('/')); ?>/wp-login.php">
			<div class="title-section">
				<h1><span>Login</span></h1>
			</div>
			<p><?php esc_html_e('Welcome! Login in to your account','hotmagazine'); ?></p>
			<label for="user_login"><?php esc_html_e('Username or email address','hotmagazine'); ?><span>*</span></label>
			<input type="text" name="log" id="user_login"/>
			<label for="user_pass"><?php esc_html_e('Password','hotmagazine'); ?><span>*</span></label>
			<input name="pwd" id="user_pass" type="password" />
			<button type="submit" id="submit-login">
				<i class="fa fa-arrow-circle-right"></i> <?php esc_html_e('Login','hotmagazine'); ?>
			</button>
			<input name="rememberme" type="checkbox" id="rememberme" value="forever"> <span><?php esc_html_e('Remember me','hotmagazine'); ?></span>

			<a class="lost-password" href="#"><?php esc_html_e('Lost your password?','hotmagazine'); ?></a>
			<?php if(get_option( 'users_can_register' )){ ?>
			<p class="register-line"><?php esc_html_e("Don't have account.","hotmagazine"); ?> <a href="#"><?php esc_html_e('Register','hotmagazine'); ?></a></p>
			<?php } ?>
		</form>
		<?php }else{ echo "<p>You are already logged in!</p>";} ?>
		<form class="lost-password-form" name="lostpasswordform" id="lostpasswordform" action="<?php echo home_url('/'); ?>/wp-login.php?action=lostpassword" method="post">
			<div class="title-section">
				<h1><span>Lost Password</span></h1>
			</div>
			<label for="username"><?php esc_html_e('Type your email address','hotmagazine'); ?><span>*</span></label>
			<input type="text" name="user_login" id="username" class="input" >
			<button type="submit" >
				<i class="fa fa-arrow-circle-right"></i> <?php esc_html_e('Submit','hotmagazine'); ?>
			</button>
			<p class="login-line"><?php esc_html_e('Back to','hotmagazine'); ?> <a href="#"><?php esc_html_e('Login','hotmagazine'); ?></a></p>
		</form>
		<?php if(get_option( 'users_can_register' )){ echo do_shortcode('[dm_registration_form]'); }?>
	</div>

	<?php wp_footer(); ?>
</body>
</html>