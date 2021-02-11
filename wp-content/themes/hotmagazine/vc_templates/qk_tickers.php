<?php
extract(shortcode_atts(array(
	'tag'=>'',
	'order'=>'',
), $atts));
wp_enqueue_script("hotmagazine-ticker", get_template_directory_uri()."/js/jquery.ticker.js",array(),false,true);
wp_enqueue_style( 'hotmagazine-ticker', get_template_directory_uri().'/css/ticker-style.css');
?>

<div class="ticker-news-box">
	<span class="breaking-news"><?php echo esc_html($tag); ?></span>
	
	<ul id="js-news" data-rtl="<?php if ( is_rtl() ) { ?>rtl<?php }else{  ?>ltr<?php }?>">
		<?php 
		
			$arr = array('post_type' => 'post', 'posts_per_page' => $order,'meta_query' => array(
					array(
						'key'     => '_hotmagazine_sticker',
						'value'   => 'on',
						'compare' => 'IN',
					),
		));
			$query = new WP_Query($arr);
			while($query->have_posts()) : $query->the_post();
		?>
		<li class="news-item"><span class="time-news"><?php echo get_post_time(get_option( 'time_format' ), true); ?></span>  <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a> <?php echo get_post_meta(get_the_ID(), '_hotmagazine_caption', true); ?> </li>
			<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
	</ul>
</div>

