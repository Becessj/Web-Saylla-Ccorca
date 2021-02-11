<?php 
/*
*Template Name: Coming Soon
*/
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<?php 
$custom  = hotmagazine_custom();
?>
<head>
	  <meta charset="<?php bloginfo( 'charset' ); ?>">
	  <link rel="profile" href="http://gmpg.org/xfn/11">
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	  <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		
			<?php if($custom['favicon']['url']!=''){ ?>
				<link rel="icon" href="<?php echo esc_url($custom['favicon']['url']); ?>" type="image/x-icon">
			<?php } ?>

		<?php } ?>
	  
	  <?php if($custom['apple_icon']['url']!=''){ ?>
	  <link rel="apple-touch-icon" href="<?php echo esc_url($custom['apple_icon']['url']); ?>" />
	  <?php } ?>
	  <?php if($custom['apple_icon_57']['url']!=''){ ?>
	  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url($custom['apple_icon_57']['url']); ?>">
	  <?php } ?>
	  <?php if($custom['apple_icon_72']['url']!=''){ ?>
	  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($custom['apple_icon_72']['url']); ?>">
	  <?php } ?>
	  <?php if($custom['apple_icon_114']['url']!=''){ ?>
	  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($custom['apple_icon_114']['url']); ?>">
	  <?php } ?>

	
	
	<?php wp_head(); ?>

</head>
<body class="comming-soon-page">

	<!-- comming-soon-page -->
	<div id="comming-soon-content">
		<div class="container">
			<div class="logo-place">
				<a  href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
					<?php if($custom['logo']['url']!=''){ ?>
						<img src="<?php echo esc_attr($custom['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
					  <?php }else{ ?>
						<?php bloginfo('name'); ?>
					  <?php } ?>
				</a>
			</div>

			<div id="clock">
				<div class="comming-part">
					<span id="days"></span>
					<p>Days</p>
				</div>
				<div class="comming-part">
					<span id="hours"></span>
					<p>Hours</p>
				</div>
				<div class="comming-part">
					<span id="minutes"></span>
					<p>Minutes</p>
				</div>
				<div class="comming-part">
					<span id="seconds"></span>
					<p>seconds</p>
				</div>				
			</div>

			<form class="subscribe">
				<p>We are Comming soon! <br> We`ll be here soon with our new awesome site, subscribe to be notified.</p>
				<input type="text" id="subscribe" name="subscribe" placeholder="Email address ..."/>
				<button type="submit" id="submit-subscribe">
					<i class="fa fa-paper-plane"></i>
					Get Notified
				</button>
			</form>

			<div class="social-box">
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a class="youtube" href="#"><i class="fa fa-youtube"></i></a></li>
					<li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
					<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
					<li><a class="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a></li>
					<li><a class="dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
					<li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
					<li><a class="flickr" href="#"><i class="fa fa-flickr"></i></a></li>
					<li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
				</ul>
			</div>

		</div>
		
	</div>
	<!-- End comming-soon-page -->
	
	<?php wp_footer(); ?>
	<script type="text/javascript">
		(function($){
			$(document).ready(function() {
				/*-------------------------------------------------*/
				/* =  comming soon & error height fix
				/*-------------------------------------------------*/
				
				try {

					$('#clock').countdown("2016/04/29", function(event) {
						var $this = $(this);
						switch(event.type) {
							case "seconds":
							case "minutes":
							case "hours":
							case "days":
							case "daysLeft":
								$this.find('span#'+event.type).html(event.value);
								break;
							case "finished":
								$this.hide();
								break;
						}
					});

				} catch(err) {

				}
			});
		})(jQuery);
	</script>
</body>
</html>