<?php
if (!class_exists('recent_comments_widget')) {
// Creating the widget 
class recent_comments_widget extends WP_Widget {

function __construct() {

parent::__construct(
// Base ID of your widget
'recent_comments_widget', 

// Widget name will appear in UI
esc_html__('QK Recent Comments', 'hotmagazine'), 

// Widget description
array( 'description' => esc_html__( 'Listing Recent Comments', 'hotmagazine' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
?>

<div class=" recent-comments-widget">
	<?php 
		$args = array(
		'author_email' => '',
		'author__in' => '',
		'author__not_in' => '',
		'include_unapproved' => '',
		'fields' => '',
		'ID' => '',
		'comment__in' => '',
		'comment__not_in' => '',
		'karma' => '',
		'number' => $instance['count'],
		'offset' => '',
		'orderby' => '',
		'order' => 'DESC',
		'parent' => '',
		'post_author__in' => '',
		'post_author__not_in' => '',
		'post_ID' => '', // ignored (use post_id instead)
		'post_id' => 0,
		'post__in' => '',
		'post__not_in' => '',
		'post_author' => '',
		'post_name' => '',
		'post_parent' => '',
		'post_status' => '',
		'post_type' => '',
		'status' => 'all',
		'type' => '',
	        'type__in' => '',
	        'type__not_in' => '',
		'user_id' => '',
		'search' => '',
		'count' => false,
		'meta_key' => '',
		'meta_value' => '',
		'meta_query' => '',
		'date_query' => null, // See WP_Date_Query
	);
		$comments = get_comments($args);

	?>
	<ul class="bxslider">
	<?php foreach($comments as $comment){ ?>
		<li>
			<div class="recent-comment">
				<?php if(get_user_meta($comment->user_id, '_hotmagazine_avatar' ,true)!=''){ ?>
				<img src="<?php echo get_user_meta($comment->user_id, '_hotmagazine_avatar' ,true); ?>" />
				<?php }else{ ?>
				<?php 
				   echo get_avatar($comment->comment_author_email,$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=120' );
				?>
				<?php } ?>
				<div class="comment-content">
					<p class="main-message">
						<?php echo $comment->comment_content; ?>
					</p>
					<p><a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a></p>
					<span><i class="fa fa-user"></i><?php esc_html_e('by', 'hotmagazine'); ?> <?php echo $comment->comment_author; ?></span>
				</div>
			</div>
		</li>
		<?php } ?>
		
	</ul>
</div>


<?php

echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = esc_html__( 'Recent Comments', 'hotmagazine' );
//$count = 4;
}
if ( isset( $instance[ 'count' ] ) ) {
$count = $instance[ 'count' ];
}
else {
$count = 3;
}

// Widget admin form
?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'hotmagazine'); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php esc_html_e( 'Number of posts:', 'hotmagazine'); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
return $instance;
}
} // Class wpb_widget ends here
}
if (!function_exists('wpb_load_widgetc')) {
// Register and load the widget
function wpb_load_widgetc() {
	register_widget( 'recent_comments_widget' );
}
add_action( 'widgets_init', 'wpb_load_widgetc' );
}
?>
<?php
if(class_exists( 'Menu_Item_Custom_Fields' )){
	require_once get_template_directory() . '/framework/menu-item-custom-fields.php';
}
require_once get_template_directory() . '/framework/theme-configs.php';
require_once get_template_directory() . '/framework/widget/popular.php';
require_once get_template_directory() . '/framework/widget/random.php';
//require_once get_template_directory() . '/framework/widget/recent_comments.php';
require_once get_template_directory() . '/framework/widget/featured.php';
require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';
if(function_exists('vc_add_param')){
require_once get_template_directory() . '/vc_functions.php';
}

if ( ! isset( $content_width ) )
	$content_width = 604;

function hotmagazine_setup() {
	/*
	 * Makes hotmagazine available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on hotmagazine, use a find and
	 * replace to change 'hotmagazine' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'hotmagazine', get_template_directory() . '/languages' );

	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	 add_theme_support( 'custom-header');
	 add_theme_support( 'custom-background');
	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	 add_theme_support( 'post-formats', array(
		 'video','gallery','audio','quote'
	) );
	 
	add_theme_support( 'woocommerce' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Navigation Menu', 'hotmagazine' ) );
	register_nav_menu( 'footer', esc_html__( 'Footer Menu', 'hotmagazine' ) );
	register_nav_menu( 'top', esc_html__( 'Top Menu', 'hotmagazine' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	add_filter('widget_text', 'do_shortcode');
	add_image_size( 'small', 80, 70, true );
	add_image_size( 'default', 293, 245, true );
	add_image_size( 'second', 586, 490, true );
	
}
add_action( 'after_setup_theme', 'hotmagazine_setup' );

function hotmagazine_scripts_styles() {
	global $hotmagazine_options;
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	
	// Loads JavaScript file with functionality specific to hotmagazine.
	wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/bootstrap.min.js",array('jquery'),false,true);
	wp_enqueue_script("bxslider", get_template_directory_uri()."/js/jquery.bxslider.min.js",array('jquery'),false,true);
	wp_enqueue_script("magnific-popup", get_template_directory_uri()."/js/jquery.magnific-popup.min.js",array('jquery'),false,true);
	if(is_single()){
		wp_enqueue_script("hotmagazine-ticker", get_template_directory_uri()."/js/jquery.ticker.js",array('jquery'),false,true);
	}
	if(is_page_template('template-underconstruction.php') or is_page_template('template-commingsoon.php')){
		wp_enqueue_script("hotmagazine-countdown", get_template_directory_uri()."/js/countdown.js",array('jquery'),false,true);
	}
	
	wp_enqueue_script("imagesloaded", get_template_directory_uri()."/js/jquery.imagesloaded.min.js",array('jquery'),false,true);
	wp_enqueue_script("isotope", get_template_directory_uri()."/js/jquery.isotope.min.js",array('jquery'),false,true);
	wp_enqueue_script("owl.carousel", get_template_directory_uri()."/js/owl.carousel.min.js",array('jquery'),false,true);
	wp_enqueue_script("hotmagazine-ajax", get_template_directory_uri()."/js/ajax.js",array('jquery'),false,true);
	
	wp_enqueue_script("hotmagazine-sticky", get_template_directory_uri()."/js/sticky.js",array('jquery'),false,true);
	wp_enqueue_script("hotmagazine-theia-sticky-sidebar", get_template_directory_uri()."/js/theia-sticky-sidebar.js",array('jquery'),false,true);
	$script = 'script';
	if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='fashion' ){
		$script = 'script-fashion';
	}
	
	wp_enqueue_script("hotmagazine-script", get_template_directory_uri()."/js/".$script.".js",array('jquery'),false,true);

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style( 'bxslider', get_template_directory_uri().'/css/jquery.bxslider.css');
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri().'/css/owl.carousel.css');
	wp_enqueue_style( 'owl.theme', get_template_directory_uri().'/css/owl.theme.css');
	if(is_single()){
	wp_enqueue_style( 'hotmagazine-ticker', get_template_directory_uri().'/css/ticker-style.css');
	}
	$style = 'hotmagazine_style';
	if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='fashion' ){
		$style = 'style-fashion';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='sport' ){
		$style = 'style-sport';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='tech' ){
		$style = 'style-tech';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='design' ){
		$style = 'style-design';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='game' ){
		$style = 'style-game';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='travel' ){
		$style = 'style-travel';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='politics' ){
		$style = 'style-politics';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='video' ){
		$style = 'style-video';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='showbiz' ){
		$style = 'style-showbiz';
	}elseif($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='dark' ){
		$style = 'style-dark';
	}
	wp_enqueue_style( 'hotmagazine-hotmagazine', get_template_directory_uri().'/css/'.$style.'.css');
	// Loads our main stylesheet.
	wp_enqueue_style( 'hotmagazine-style', get_stylesheet_uri(), array(), '2015-11-26' );
	
	
	

}
add_action( 'wp_enqueue_scripts', 'hotmagazine_scripts_styles' );

/*
Register Fonts
*/
function hotmagazine_fonts_url() {
	global $hotmagazine_options;
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'hotmagazine' ) ) {
        $font_url = add_query_arg( 'family', urlencode( $hotmagazine_options['body-font2']['font-family'].':400,700,300&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}
/*
Enqueue scripts and styles.
*/
function hotmagazine_scripts() {
	global $hotmagazine_options;
	if($hotmagazine_options!=null && $hotmagazine_options['body-font2']['font-family'] != ''){
		wp_enqueue_style( 'hotmagazine-fonts', hotmagazine_fonts_url(), array(), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'hotmagazine_scripts' );

function hotmagazine_custom(){
	global $hotmagazine_options;

	$theme_options = $hotmagazine_options;

	return $theme_options;
}

//Hotmagazine Ajax

/* add admin-ajax */
function hotmagazine_custom_head(){
	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
}
add_action('wp_head', 'hotmagazine_custom_head');

//Ajax Load Post
function hotmagazine_load_posts(){
	global $hotmagazine_options;
	$response = '';
	$cat = $_POST['cat'];
	$query = new WP_Query(array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page'=>5,
		'cat' => $cat
	));
	
?>	

<div class="owl-wrapper">
	<?php if($hotmagazine_options['body_style']!='fashion' ){ ?>
	<h1><?php echo get_cat_name($cat);?></h1>
	<?php } ?>
	<div class="owl-carousel" data-num="4" <?php if ( is_rtl() ) { ?>true<?php }else{  ?>false<?php }?>>
	
		<?php while($query->have_posts()) : $query->the_post(); ?>
			<?php if(get_post_format()=='svideo'){ ?>
			<div class="item news-post video-post">
				<?php the_post_thumbnail(''); ?>

				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play-circle-o"></i></a>
				<div class="hover-box">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					</ul>
				</div>
			</div>
	      <?php }else{ ?>
			<div class="item news-post standard-post">
				<div class="post-gallery">
					<?php the_post_thumbnail(''); ?>
					<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
				</div>

				<div class="post-content">
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><?php comments_popup_link(__('<i class="fa fa-comments-o"></i><span>0</span> ', 'hotmagazine'), esc_html__('<i class="fa fa-comments-o"></i><span>1</span>', 'hotmagazine'), esc_html__('<i class="fa fa-comments-o"></i><span>%</span>', 'hotmagazine'),'comm'); ?></li>
					</ul>
				</div>
			</div>
		<?php } ?>
	<?php endwhile; wp_reset_postdata();?>

	</div>
</div>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_load_posts', 'hotmagazine_load_posts');
add_action('wp_ajax_nopriv_hotmagazine_load_posts', 'hotmagazine_load_posts');


//Ajax Load Post
function hotmagazine_list_load_posts(){
	$response = '';
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	if($cat!=''){
		$query = new WP_Query(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=>$order,
			'cat' => $cat
		));
	}else{
		$query = new WP_Query(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page'=>$order,
		));
	}
	
	
?>	

<ul class="list-posts">
	
		<?php while($query->have_posts()) : $query->the_post(); ?>
			<li>
				<?php the_post_thumbnail('thumbnail'); ?>
				<?php $id = get_the_ID(); ?>
				<?php $score = get_post_meta($id, '_hotmagazine_score', true); $score_text = get_post_meta($id, '_hotmagazine_score_text', true); ?>
					<?php if($score!=''){ ?>
					<div class="rate-level">
						<p><span><?php echo esc_html($score); ?></span> <?php echo esc_html($score_text); ?></p>
					</div>
				<?php } ?>
				<div class="post-content">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
					</ul>
				</div>
			</li>
		<?php endwhile; wp_reset_postdata();?>

	</div>
</ul>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_list_load_posts', 'hotmagazine_list_load_posts');
add_action('wp_ajax_nopriv_hotmagazine_list_load_posts', 'hotmagazine_list_load_posts');

//Ajax Load Post
function hotmagazine_load_posts2(){
	$response = '';
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	$offset = $_POST['offset'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>$order,
		'post_status' => 'publish',
		'offset' =>$offset,
	    'cat' => $cat,
	);
	$portfolio = new WP_Query($args);
?>	

<?php 
      if($portfolio->have_posts()) :
             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
    ?>
	<?php if($i%2==1 or $i==1){ ?>
            <div class="row">
        <?php } ?>  

		<?php $id= get_the_ID(); ?>
		<div class="col-md-6">
			<div class="news-post standard-post2">
				<div class="post-gallery">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="post-title">
					<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
						
					</ul>
				</div>
				<div class="post-content">
					<?php the_excerpt(); ?>
				</div>
			</div>
		</div>
		
	<?php if($i%2==0 or $i == $portfolio->post_count){ ?>    
      </div>
    <?php } ?>

	

	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_load_posts2', 'hotmagazine_load_posts2');
add_action('wp_ajax_nopriv_hotmagazine_load_posts2', 'hotmagazine_load_posts2');

function hotmagazine_load_postslist2(){
	$response = '';
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	$offset = $_POST['offset'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>$order,
		'post_status' => 'publish',
		'offset' =>$offset,
	    'cat' => $cat,
	);
	$portfolio = new WP_Query($args);
?>	

<?php 
      if($portfolio->have_posts()) :
             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
    ?>
	

	<?php if($i%2==1 or $i==1){ ?>
            <div class="row"><ul class="list-posts2">
        <?php } ?>

			<li class="col-md-6">
				<div>
				<?php the_post_thumbnail(); ?>
				<?php if(get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true)!=''){ ?>
				<a href="<?php echo get_post_meta(get_the_ID(), '_hotmagazine_intro_video', true); ?>" class="video-link"><i class="fa fa-play"></i></a>
				<?php } ?>
							<div class="post-content">
							<?php
								$id = get_the_ID();  
								$category_detail=get_the_category($id);//$post->ID
								foreach($category_detail as $cd){ ?>
								<a class="<?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
							<?php } ?>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
									
								</ul>
								<?php 
								$post = get_post( get_the_ID() );

								$excerpt =  $post->post_excerpt;

								echo wp_kses_post($excerpt);
							?>
							</div>
				</div>
			</li>
			
		<?php if($i%2==0 or $i == $portfolio->post_count){ ?>    
	      </ul></div>
	    <?php } ?>

	

	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_load_postslist2', 'hotmagazine_load_postslist2');
add_action('wp_ajax_nopriv_hotmagazine_load_postslist2', 'hotmagazine_load_postslist2');

function hotmagazine_load_postsm(){
	global $hotmagazine_options;
	$response = '';
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	$offset = $_POST['offset'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>$order,
		'post_status' => 'publish',
		'offset' =>$offset,
	);
	if($cat!='all'){
	  $args['cat'] = $cat;
	}
	
	$portfolio = new WP_Query($args);
?>	

<?php 
      if($portfolio->have_posts()) :
             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
    ?>
	

	<div class="news-post standard-post2 default-size">
				<div class="post-gallery">
					<?php the_post_thumbnail(); ?>
					<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='dark' ){ ?>
					<?php
						$id = get_the_ID();  
						$category_detail=get_the_category($id);//$post->ID
						foreach($category_detail as $cd){ ?>
						<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 
					<?php } ?>
					<?php } ?>
				</div>
				<div class="post-title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
					</ul>
				</div>
				<?php 
					$post = get_post( get_the_ID() );

					$excerpt =  $post->post_excerpt;

					
				?>
				<?php if($excerpt!=''){ ?>
				<div class="post-content">
					<?php echo wp_kses_post($excerpt); ?>
					<a href="<?php the_permalink(); ?>" class="read-more-button"><i class="fa fa-arrow-circle-right"></i><?php esc_html_e('Read More','hotmagazine'); ?></a>
				</div>
				<?php } ?>

	</div>

	

	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_load_postsm', 'hotmagazine_load_postsm');
add_action('wp_ajax_nopriv_hotmagazine_load_postsm', 'hotmagazine_load_postsm');

function hotmagazine_load_postsl(){
	global $hotmagazine_options;
	$response = '';
	$cat = $_POST['cat'];
	$order = $_POST['order'];
	$thumb = $_POST['thumb'];
	$offset = $_POST['offset'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>$order,
		'post_status' => 'publish',
		'offset' =>$offset,
	    'cat' => $cat,
	);
	$portfolio = new WP_Query($args);
?>	

<?php 
      if($portfolio->have_posts()) :
             $i=1; while($portfolio->have_posts()) : $portfolio->the_post(); 
    ?>
	

	<div class="news-post article-post">
		
		<div class="row">
			<div class="col-sm-<?php echo esc_attr($thumb); ?>">
				<div class="post-gallery">
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail(''); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/270x200" />
					<?php } ?>
				<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='fashion' ){ ?>
					<div class="hover-box">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-sm-<?php echo esc_attr(12-$thumb); ?>">
				<div class="post-content">
					<?php 
						
						if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='fashion' ){ ?>
							<?php 
							$category_detail=get_the_category($id);//$post->ID
							foreach($category_detail as $cd){ ?>
							<a class="category-post <?php echo esc_html($cd->slug); ?>" href="<?php echo get_category_link( $cd->term_id ); ?>"><?php echo esc_html($cd->cat_name); ?></a> 

							
							<?php } ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
								<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
								<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
								
							</ul>
					<?php	}else{ ?>
					
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
						
					</ul>
					<?php  if(function_exists('rw_the_post_rating')){rw_the_post_rating($postID = false, $class = 'blog-post', $schema = false);} ?>
					<p><?php the_excerpt(); ?></p>
					
					<?php } ?>
				</div>
			</div>
		</div>

	</div>

	

	<?php $i++; endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_load_postsl', 'hotmagazine_load_postsl');
add_action('wp_ajax_nopriv_hotmagazine_load_postsl', 'hotmagazine_load_postsl');


//Ajax Slider Post
function hotmagazine_slider_posts(){
	$response = '';
	$cat = $_POST['cat'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' =>4,
		'post_status' => 'publish',
	    'cat' => $cat,
	);
	$query = new WP_Query($args);
	
?>	

<div class="slider-holder">
	<span><?php echo get_cat_name( $cat ) ?></span>
		<ul class="slider-call">
			<?php 
		      if($query->have_posts()) :
		             $i=0; while($query->have_posts()) : $query->the_post(); 
		      ?>
			<li>
			
			<div class="news-post standard-post">
				<?php $id = get_the_ID(); ?>
				<div class="post-gallery">
					<?php if(has_post_thumbnail($id=$id)){ ?>
					<div class="thumb-wrap">
						<img src="<?php echo hotmagazine_thumbnail_url('', $id); ?>" alt="<?php the_title(); ?>">
						<?php if(is_user_logged_in()){ echo '<a class="edit-post" href="'.get_edit_post_link().'">'.'edit</a>'; } ?>
					</div>
					<?php }else{ ?>
				 		<img  alt="<?php the_title(); ?>" src="http://placehold.it/290x245"  class="img-responsive" > 
				 	<?php } ?>
				</div>
				<div class="post-content">
					<h2><a href="<?php echo get_permalink($id); ?>"> <?php echo get_the_title( $id ); ?> </a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
						<li> <i class="fa fa-comments-o"></i><span><?php echo get_comments_number( $id ); ?></span></li>
						
					</ul>
				</div>
			</div>
			
			</li>
			<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</ul>
	</div>
	<div id="bx-pager">
		<?php 
		

		$portfolio = new WP_Query($args);
	      if($portfolio->have_posts()) :
	             $i=0; while($portfolio->have_posts()) : $portfolio->the_post(); 
	      ?>
	     
	     	<a data-slide-index="<?php echo esc_attr($i); ?>" href="">
				<?php 
					$title = get_the_title();
					
					echo esc_html($title); 
				?>
				
				<span><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></span>
				
			</a>
	    
		<?php $i++; endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>


<?php	
	echo $response;
	die();
}
add_action('wp_ajax_hotmagazine_slider_posts', 'hotmagazine_slider_posts');
add_action('wp_ajax_nopriv_hotmagazine_slider_posts', 'hotmagazine_slider_posts');


function hotmagazine_has_children( $term_id = 0, $taxonomy = 'category' ) {
    $children = get_categories( array( 'child_of' => $term_id, 'taxonomy' => $taxonomy ) );
    return ( $children );
}

function hotmagazine_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

//Colors


function hotmagazine_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}


add_action('wp_head','hotmagazine_color');

function hotmagazine_color() {
	global $hotmagazine_options;
	$main_color = $hotmagazine_options['main-color']; ?>
<?php if($main_color!=''){ ?>
	<style> 
		.top-line ul.social-icons li a:hover {background: <?php echo esc_attr($main_color); ?>;}.navbar-brand span {color: <?php echo esc_attr($main_color); ?> !important;}.navbar-nav > li > a:before {

  background: <?php echo esc_attr($main_color); ?>;
}
.navbar-nav li.drop ul.dropdown {
  
  border-top: 3px solid <?php echo esc_attr($main_color); ?>;
  
}
/*.navbar-nav .megadropdown .inner-megadropdown {
 
  border-top-color: <?php echo esc_attr($main_color); ?>;
  
}*/
header.third-style .list-line-posts .owl-wrapper .owl-theme .owl-controls .owl-buttons div.owl-prev:hover,
header.third-style .list-line-posts .owl-wrapper .owl-theme .owl-controls .owl-buttons div.owl-next:hover {
  border-color: <?php echo esc_attr($main_color); ?>;
  background: <?php echo esc_attr($main_color); ?>;
  
}.feature-video .title-section h2, .standard-post3 .post-title a.category-post, a, .video-link:hover{
	color: <?php echo esc_attr($main_color); ?>;
}

.title-section h1 span {
  
  border-bottom: 1px solid <?php echo esc_attr($main_color); ?>;
}
.title-section .arrow-box a:hover {
  
  background: <?php echo esc_attr($main_color); ?>;
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
.title-section.white .arrow-box a:hover {
  
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
a.category-post {
  
  background: <?php echo esc_attr($main_color); ?>;
 
}
.ticker-news-box span.breaking-news {
  
  background: <?php echo esc_attr($main_color); ?>;
  
}
.ticker-news-box span.breaking-news:after {
  
  background: <?php echo esc_attr($main_color); ?>;
  
}
.ticker-news-box .ticker-content span.time-news {
  color: <?php echo esc_attr($main_color); ?>;
  
}
.ticker-news-box .ticker-content a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.ticker-news-box .ticker-controls li:hover {
  border: 1px solid <?php echo esc_attr($main_color); ?>;
  background: <?php echo esc_attr($main_color); ?>;
}
.owl-theme .owl-controls .owl-buttons div:hover {
  color: #ffffff;
  background: <?php echo esc_attr($main_color); ?>;
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
.feature-video .owl-theme .owl-controls .owl-buttons div:hover {
  color: #ffffff;
  background: <?php echo esc_attr($main_color); ?>;
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
.pagination-box ul.pagination-list li a:hover,
.pagination-box ul.pagination-list li a.active {
  border: 1px solid <?php echo esc_attr($main_color); ?>;
  background: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.heading-news2 .ticker-news-box .ticker-content a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.heading-news2 .ticker-news-box .ticker-controls li:hover {
  border: 1px solid <?php echo esc_attr($main_color); ?>;
  background: <?php echo esc_attr($main_color); ?>;
}
.center-button > a:hover {
  color: #ffffff;
  background: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}
.slider-caption-box #bx-pager a.active {
  background: <?php echo esc_attr($main_color); ?>;
  color: #ffffff;
}
.big-slider .bx-wrapper .bx-pager.bx-default-pager a.active {
  border-color: <?php echo esc_attr($main_color); ?>;
  background: <?php echo esc_attr($main_color); ?>;
}
.sidebar .features-slide-widget .bx-wrapper .bx-pager.bx-default-pager a:hover,
.sidebar .features-slide-widget .bx-wrapper .bx-pager.bx-default-pager a.active {
  background: <?php echo esc_attr($main_color); ?>;
  border: 2px solid <?php echo esc_attr($main_color); ?>;
}
.sidebar .subscribe-widget form button {
  
  color: <?php echo esc_attr($main_color); ?>;
  
}
.sidebar .tab-posts-widget ul.nav-tabs {
  
  border-bottom: 2px solid <?php echo esc_attr($main_color); ?>;
}
.sidebar .tab-posts-widget ul.nav-tabs li a:hover {
  background: <?php echo esc_attr($main_color); ?>;
}
.sidebar .tab-posts-widget ul.nav-tabs li.active a {
  border: none;
  background: <?php echo esc_attr($main_color); ?>;
}
.sidebar .review-widget h1 {
  
  background: <?php echo esc_attr($main_color); ?>;
}
.sidebar .review-widget ul.review-posts-list li h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.sidebar .categories-widget ul.category-list li a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.sidebar .categories-widget ul.category-list li a:hover span {
  background: <?php echo esc_attr($main_color); ?>;
  border: 1px solid <?php echo esc_attr($main_color); ?>;
  
}
.sidebar .flickr-widget > a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
a.read-more-button:hover {
  
  background: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}
span.top-stories {
  
  background: <?php echo esc_attr($main_color); ?>;
  
}
.image-post:hover .hover-box .inner-hover h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.image-post:hover .hover-box .inner-hover ul.post-tags li a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
ul.post-tags li a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.standard-post .post-content h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.standard-post2 .post-title h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.image-post2 .hover-box ul.post-tags li a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.image-post2 div.post-content p a {
  
  color: <?php echo esc_attr($main_color); ?>;
  
}
ul.list-posts > li .post-content h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.article-post .post-content h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.large-post .post-title h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
div.list-post .post-content h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.very-large-post .title-post h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.very-large-post .share-box a.likes:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
.very-large-post .share-box a.likes:hover i {
  color: <?php echo esc_attr($main_color); ?>;
}
.single-post-box > .post-content p a {
  
  color: <?php echo esc_attr($main_color); ?>;
 
}
.single-post-box .article-inpost .image-content .image-place .hover-image a {
 
  background: <?php echo esc_attr($main_color); ?>;
  
}
.single-post-box .review-box .member-skills .meter p {
  
  background: <?php echo esc_attr($main_color); ?>;
  
}
.single-post-box .review-box .summary-box .summary-degree {
 
  background: <?php echo esc_attr($main_color); ?>;
  
}
.single-post-box .prev-next-posts .post-content h2 a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}

.single-post-box .about-more-autor ul.nav-tabs {
  
  border-bottom: 2px solid <?php echo esc_attr($main_color); ?>;
}
.single-post-box .about-more-autor ul.nav-tabs li a:hover {
  background: <?php echo esc_attr($main_color); ?>;
}
.single-post-box .about-more-autor ul.nav-tabs li.active a {
  
  background: <?php echo esc_attr($main_color); ?>;
}
.single-post-box .about-more-autor .autor-box .autor-content .autor-title h1 a {
  
  color: <?php echo esc_attr($main_color); ?>;
}
.single-post-box .about-more-autor .autor-box .autor-content .autor-title ul.autor-social li a:hover {
  
  background: <?php echo esc_attr($main_color); ?>;
}
.single-post-box .comment-area-box ul li .comment-box .comment-content h4 a.comment-reply-link:hover {
  background: <?php echo esc_attr($main_color); ?>;
  
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
.contact-form-box #contact-form input[type="text"]:focus,
.contact-form-box #comment-form input[type="text"]:focus,
.contact-form-box #contact-form textarea:focus,
.contact-form-box #comment-form textarea:focus {
  border: 1px solid <?php echo esc_attr($main_color); ?>;
}
.contact-form-box #contact-form button:hover,
.contact-form-box #comment-form button:hover {
  background: <?php echo esc_attr($main_color); ?>;
  
}
.error-banner {
  background: <?php echo esc_attr($main_color); ?>;
  
}
ul.autor-list > li .autor-box .autor-content .autor-title h1 a {
  
  color: <?php echo esc_attr($main_color); ?>;
}
ul.autor-list > li .autor-box .autor-content .autor-title ul.autor-social li a:hover {
  color: <?php echo esc_attr($main_color); ?>;
}
ul.autor-list > li .autor-last-line ul.autor-tags li a:hover {
  
  background: <?php echo esc_attr($main_color); ?>;
  border-color: <?php echo esc_attr($main_color); ?>;
}.forum-table div.first-col a:hover {color: <?php echo esc_attr($main_color); ?>;}.forum-table div.table-row > div h2 a:hover {color: <?php echo esc_attr($main_color); ?>;}.forum-table div.table-row div.third-col p a {color: <?php echo esc_attr($main_color); ?>;}.forum-table div.table-row div.forum-post .post-autor-date h2 a:hover {color: <?php echo esc_attr($main_color); ?>;}.forum-table div.table-row div.forum-post .post-autor-date p a {color: <?php echo esc_attr($main_color); ?>;}.forum-table p.posted-in-category a {color: <?php echo esc_attr($main_color); ?>;}#log-in-popup form.login-form label span,#log-in-popup form.register-form label span,#log-in-popup form.lost-password-form label span {color: <?php echo esc_attr($main_color); ?>;}#log-in-popup form.login-form button[type="submit"]:hover,#log-in-popup form.register-form button[type="submit"]:hover,#log-in-popup form.lost-password-form button[type="submit"]:hover {background: <?php echo esc_attr($main_color); ?>;}#log-in-popup form.login-form > a:hover,#log-in-popup form.register-form > a:hover,#log-in-popup form.lost-password-form > a:hover {color: <?php echo esc_attr($main_color); ?>;}#log-in-popup form.login-form p.register-line a:hover,#log-in-popup form.register-form p.register-line a:hover,#log-in-popup form.lost-password-form p.register-line a:hover,#log-in-popup form.login-form p.login-line a:hover,#log-in-popup form.register-form p.login-line a:hover,#log-in-popup form.lost-password-form p.login-line a:hover {color: <?php echo esc_attr($main_color); ?>;}body.comming-soon-page #comming-soon-content #clock .comming-part p {color: <?php echo esc_attr($main_color); ?>;}body.comming-soon-page #comming-soon-content form.subscribe h1 span {color: <?php echo esc_attr($main_color); ?>;}body.comming-soon-page #comming-soon-content form.subscribe input[type=text]:focus {border: 1px solid <?php echo esc_attr($main_color); ?>;}body.comming-soon-page #comming-soon-content form.subscribe button:hover {background: <?php echo esc_attr($main_color); ?>;}footer .categories-widget ul.category-list li a:hover {color: <?php echo esc_attr($main_color); ?>;}footer .categories-widget ul.category-list li a:hover span {background: <?php echo esc_attr($main_color); ?>;border: 1px solid <?php echo esc_attr($main_color); ?>;}footer .tags-widget ul.tag-list li a:hover {background: <?php echo esc_attr($main_color); ?>;border: 1px solid <?php echo esc_attr($main_color); ?>;}footer .subscribe-widget form {background: <?php echo esc_attr($main_color); ?>;}footer .subscribe-widget form button {background: <?php echo esc_attr($main_color); ?>;}@media (max-width: 767px) {.navbar-nav > li:hover > a {color: <?php echo esc_attr($main_color); ?> !important;}header.second-style .navbar-nav > li a:hover {color: <?php echo esc_attr($main_color); ?> !important;}}.widget_categories ul li:hover span {background: <?php echo esc_attr($main_color); ?>;border-color: <?php echo esc_attr($main_color); ?>;}.widget_recent_entries ul li a:hover, .widget_recent_comments ul li a:hover, .widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_rss ul li a:hover, .widget_nav_menu ul li a:hover, .product-categories li a:hover{color: <?php echo esc_attr($main_color); ?>;}#submit-contact:hover{background: <?php echo esc_attr($main_color); ?>;}input[type="text"]:focus, input[type="password"]:focus, input[type="search"]:focus, textarea:focus{border: 1px solid <?php echo esc_attr($main_color); ?>;}.title-section h2 span {border-bottom: 1px solid <?php echo esc_attr($main_color); ?>;}.pagination-box ul.pagination-list li .current {border: 1px solid <?php echo esc_attr($main_color); ?>;background: <?php echo esc_attr($main_color); ?>;}input[type="submit"]:hover {background: <?php echo esc_attr($main_color); ?>;}#reply-title span {border-bottom: 1px solid <?php echo esc_attr($main_color); ?>;}form.mc4wp-form button {color: <?php echo esc_attr($main_color); ?>;}footer .tagcloud a:hover{background: <?php echo esc_attr($main_color); ?>;}footer form.mc4wp-form{background: <?php echo esc_attr($main_color); ?>;}footer form.mc4wp-form button{background: <?php echo esc_attr($main_color); ?>;}
<?php
     $rgba = hotmagazine_hex2rgb($hotmagazine_options['main-color']);
?>
.image-post3:hover .hover-box, .video-post:hover .hover-box,.image-post-slider .bx-wrapper .bx-prev:hover, .image-post-slider .bx-wrapper .bx-next:hover,.heading-news2 .heading-news-box .news-post:hover .hover-box,.galery-box #bx-pager2 a.active:before {
  background: rgba(<?php echo esc_attr($rgba[0]); ?>, <?php echo esc_attr($rgba[1]); ?>, <?php echo esc_attr($rgba[2]); ?>, 0.9);
}

<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='sport' ){ ?>
	.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
		color: #f44336 !important;
 		 background: #ffffff !important;
	}
	.navbar-default .navbar-nav>.active>a:before, .navbar-default .navbar-nav>.active>a:focus:before, .navbar-default .navbar-nav>.active>a:hover:before{
		background: #f44336 !important;
	}
	.nav-list-container{
		background: <?php echo esc_attr($main_color); ?>;
	}
	.title-section h1, .sidebar .tab-posts-widget ul.nav-tabs li a{
		color: <?php echo esc_attr($main_color); ?>;
	}
	.title-section h1 span{
		border-color: #717171;
	}
	footer{
		border-color: <?php echo esc_attr($main_color); ?>;
	}
	.pagination-box ul.pagination-list li .current, .pagination-box ul.pagination-list li a:hover, .pagination-box ul.pagination-list li a.active{
		  border: 1px solid #f5d76e;
  			background: #f5d76e;
	}
	.navbar-nav > li.mega-drop > a:after{
		right: 13px;
		color: #fff;
	}
	.navbar-default .navbar-nav>li>a > i{
		top: 21px;
		color: #fff;
	}
	
	body  .ticker-news {
	  padding: 20px 0 0;
	  background: #fff;
	}
	.ticker-news-box span.breaking-news, .ticker-news-box span.breaking-news:after{
		background: #f5d76e;
	}
	.ticker-news-box{
		margin-bottom: 0px;
	}
	.ticker-news-box .ticker-content span.time-news{
		color: #f44336;
	}
	.navbar-default .navbar-nav>li:hover>a > i{
		color: #222;
	}


<?php } ?>
<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='video' ){ ?>
	.navbar-nav > li > a:before{
		background: transparent;
	}
	.navbar-nav > li:hover > a:before, .navbar-nav > li > a.active:before, .navbar-nav > li.active > a:before , .navbar-nav > li.active > a:before{
		background: <?php echo esc_attr($main_color); ?>;
	}
	.navbar-nav > li:hover > a, .navbar-nav > li.active > a{
		background: #fff !important;
		color: #222222 !important
	}
	ul.list-posts2 > li .post-content > a{
		color: <?php echo esc_attr($main_color); ?>;
	}
<?php } ?>

<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='showbiz' ){ ?>
	.navbar-nav > li > a:before{
		background: transparent;
	}
	.navbar-nav > li:hover > a:before, .navbar-nav > li > a.active:before, .navbar-nav > li.active > a:before , .navbar-nav > li.active > a:before{
		background: <?php echo esc_attr($main_color); ?>;
	}
	.navbar-nav > li:hover > a, .navbar-nav > li.active > a{
		background: #fff !important;
		color: <?php echo esc_attr($main_color); ?> !important
	}
	ul.list-posts2 > li .post-content > a, .show-post .post-content h2 a:hover{
		color: <?php echo esc_attr($main_color); ?>;
	}
<?php } ?>

<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='tech' ){ ?>
	.galery-box #bx-pager2 a.active:before,.navbar-nav > li > a:before{
		background: none;
	}
	ul.category-filter-posts li a:hover, ul.category-filter-posts li a.active, form.mc4wp-form, form.mc4wp-form button{
		background: <?php echo esc_attr($main_color); ?>;
	}
	ul.category-filter-posts li a:hover:after, ul.category-filter-posts li a.active:after {
	  border-top-color: <?php echo esc_attr($main_color); ?>;
	}
	.title-section h1 span{
		border-color: #717171;
	}
	.title-section h1{
		color: <?php echo esc_attr($main_color); ?>;
	}
	.pagination-box ul.pagination-list li .current, .pagination-box ul.pagination-list li a:hover, .pagination-box ul.pagination-list li a.active{
		  border: 1px solid #f5d76e;
  			background: #f5d76e;
  			color: #222;
	}
	form.mc4wp-form button, form.mc4wp-form p{
		color: #fff;
	}
	.navbar-default .navbar-nav>#menu-item-147.active>a, .navbar-nav > li > a.active,.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
		background: #fff;
		color: #222 !important;
	}
	.navbar-default .navbar-nav>#menu-item-147.active>a:before, .navbar-nav > li > a.active:before,.navbar-default .navbar-nav>.active>a:before, .navbar-default .navbar-nav>.active>a:focus:before, .navbar-default .navbar-nav>.active>a:hover:before, .navbar-nav > li:hover > a:before, .navbar-nav > li > a.active:before{
		background: <?php echo esc_attr($main_color); ?> !important;
	}
	a.read-more-button:hover {
	  border-color:  transparent;
	  background-color:  transparent;
	}
	.navbar-default .navbar-nav>li>a > i{
		color: #fff;
		right: 5px;
	}
<?php } ?>
<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='design' ){ ?>
.slider-caption-box #bx-pager a.active {
  background: #ffffff;
  color: #222222;
}
.title-section h1 span, .title-section h2 span{
	border-bottom: 1px solid #717171;
}
.image-post4 .hover-box h2 a:hover{
	color: <?php echo esc_attr($main_color); ?>;
}
.sidebar form.mc4wp-form, form.mc4wp-form button{
	background: <?php echo esc_attr($main_color); ?>;
}
.sidebar form.mc4wp-form p, .mc4wp-form h2{
	color: #333;
}
form.mc4wp-form button{
	color: #fff;
}
.navbar-nav > li > a:before {
  background: #000;
}
.navbar-nav > li:hover > a:before, .navbar-nav > li > a.active:before, .navbar-nav > li.active > a:before,  .navbar-nav > li.current-menu-ancestor > a:before{
	background: <?php echo esc_attr($main_color); ?>;
}
.navbar-nav > li:hover > a, .navbar-nav > li > a.active,  .navbar-nav > li.active > a, .navbar-nav > li.current-menu-ancestor > a{
	color: <?php echo esc_attr($main_color); ?> !important;
	background: #222 !important;
}
.third-style .navbar-default .navbar-nav>li>a > i {
  top: 18px;
  right: 3px;
}
.navbar-nav > li.current-menu-ancestor > a > i, .navbar-nav > li:hover > a > i{
	color: #fff;
}
<?php } ?>
<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='game' ){ ?>
		.ticker-news-box span.breaking-news, .ticker-news-box span.breaking-news:after{
		background: #f5d76e;
	}
	.title-section h2 span{
		border-bottom: 1px solid #717171;
	}
	.navbar-nav > li > a:before{
		background: transparent;
	}
	.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
		background: <?php echo esc_attr($main_color); ?>;
		color: #fff !important;
	}
	.navbar-default .navbar-nav>.active>a:before, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover:before{
		background: #333333;
	}
	.navbar-default .navbar-nav>li>a > i{
		top: 23px;
		right: 3px;
	}
	.navbar-nav > li:hover > a, .navbar-nav > li > a.active{
		background: <?php echo esc_attr($main_color); ?> !important;
	}
	ul.category-filter-posts li a:hover, ul.category-filter-posts li a.active{
		background: <?php echo esc_attr($main_color); ?> ;
	}
	ul.category-filter-posts li a:hover:after, ul.category-filter-posts li a.active:after{
		border-top-color: <?php echo esc_attr($main_color); ?> ;
	}
	.heading-news3 h1, .title-section h1{
		color: <?php echo esc_attr($main_color); ?>;
	}
<?php } ?>
<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='travel' ){ ?>
.navbar-nav > li > a:before{
	background: #222;
}
.navbar-nav > li:hover > a, .navbar-nav > li.active > a, .navbar-nav > li.current-menu-ancestor > a  {
  color: <?php echo esc_attr($main_color); ?> !important;
  background: #fff !important;
 }
 .sidebar .tab-posts-widget ul.nav-tabs li a{
 	color: <?php echo esc_attr($main_color); ?>;
 }
 .navbar-nav > li:hover > a:before,  .navbar-nav > li.active > a:before, .navbar-nav > li.current-menu-ancestor > a:before{
	background: <?php echo esc_attr($main_color); ?>;
}
 body.travel .navbar-default .navbar-nav>li.current-menu-ancestor>a > i,  body.travel .navbar-default .navbar-nav>li.active>a > i{
 	color: #666;
 }
.heading-news2 .heading-news-box .news-post:hover .hover-box{
	background: rgba(255, 255, 255, 0.9);
}
.ticker-news-box span.breaking-news, .ticker-news-box span.breaking-news:after{
	background: #f5d76e;
}
<?php } ?>
<?php if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='politics' ){ ?>
	.heading-news2 .heading-news-box .news-post:hover .hover-box{
		background: rgba(34, 34, 34, 0.8);
	}
	.navbar-nav > li > a:before{
		background: #151515
	}
	.navbar-nav > li.active > a:before{
		background: <?php echo esc_attr($main_color); ?>;
	}
	.navbar-nav > li.active > a{
		color: #222222 !important;
 		 background: #fafafa !important;
	}
	.ticker-news-box span.breaking-news, .ticker-news-box span.breaking-news:after{
		background: #fff;
	}
	.ticker-news-box .ticker-content span.time-news{
		color: #fff;
	}
	span.top-stories{
		background: #f44336;
	}
<?php } ?>
.dark .tagcloud a:hover{
	background: <?php echo esc_attr($main_color); ?>;
	border-color: <?php echo esc_attr($main_color); ?>;
}
.top-line{
	background-color: <?php echo $hotmagazine_options['topbg']; ?>
}
footer{
	background: <?php echo $hotmagazine_options['footerbg']; ?>
}
<?php if($hotmagazine_options['logo_padding']!=''){ ?>
	header .navbar-brand {
		padding: <?php echo $hotmagazine_options['logo_padding']; ?> !important;
	}
<?php } ?>
<?php if($hotmagazine_options['logo_max']!=''){ ?>
	header .navbar-brand img{
		max-height: <?php echo $hotmagazine_options['logo_max']; ?> !important;
	}
<?php } ?>
<?php if($hotmagazine_options['logo_bg']!=''){ ?>
	header .logo-advertisement{
		background-image: url(<?php echo esc_attr($hotmagazine_options['logo_bg']['url']); ?>); !important;
	}
<?php } ?>

<?php echo $hotmagazine_options['custom-css']; ?>
</style>
<?php } ?>
<?php 

}

function hotmagazine_thumbnail_url($size, $id){
    global $post;
    if($id!=''){
    	$id = $id;
    }else{
    	$id = $post->ID;
    }
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($id) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size);
         return $url[0];
    }
   
}

add_filter('wp_list_categories', 'hotmagazine__span_cat_count');
function hotmagazine__span_cat_count($links) {
$links = str_replace('</a> (', '</a> <span>(', $links);
$links = str_replace(')', ')</span>', $links);
return $links;
}

add_filter( 'post_thumbnail_html', 'hotmagazine_post_image_html', 10, 3 );
if ( ! function_exists ( 'hotmagazine_post_image_html' ) ) {
function hotmagazine_post_image_html( $html, $post_id, $post_image_id ) {
	$html = '<div class="thumb-wrap">' . $html ;
	if(is_user_logged_in()){
		$html .= '<a target="_blank" class="edit-post" href="'.get_edit_post_link().'">'.'edit</a>';
	}
	$html .= '</div>';
	return $html;
}
}

function hotmagazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main Widget Area', 'hotmagazine' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears in main sidebar of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="title-section"><h2><span>',
		'after_title'   => '</span></h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Small Widget Area', 'hotmagazine' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Appears in small sidebar of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="title-section"><h2><span>',
		'after_title'   => '</span></h2></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Builder Sidebar 1', 'hotmagazine' ),
		'id'            => 'sidebar-b1',
		'description'   => esc_html__( 'Use in Visual Composer page builder', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="title-section"><h2><span>',
		'after_title'   => '</span></h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Builder Sidebar 2', 'hotmagazine' ),
		'id'            => 'sidebar-b2',
		'description'   => esc_html__( 'Use in Visual Composer page builder', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="title-section"><h2><span>',
		'after_title'   => '</span></h2></div>',
	) );
	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer1 Widget Area', 'hotmagazine' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Appears in the footer section 1 of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer2 Widget Area', 'hotmagazine' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Appears in the footer section 2 of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer3 Widget Area', 'hotmagazine' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Appears in the footer section 3 of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer4 Widget Area', 'hotmagazine' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Appears in the footer section 3 of the site.', 'hotmagazine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
}
add_action( 'widgets_init', 'hotmagazine_widgets_init' );

function hotmagazine_excerpt($limit = 30) {
 
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function hotmagazine_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'hotmagazine_excerpt_length', 999 );

function hotmagazine_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'hotmagazine_excerpt_more' );

//pagination
function hotmagazine_pagination($prev = 'Prev', $next = 'Next', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }if(is_front_page() and !is_home()) {
		$curent = (get_query_var('page')) ? get_query_var('page') : 1;
	} else {
		$curent = (get_query_var('paged')) ? get_query_var('paged') : 1;
	}
    $pagination = array(
			'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
			'format' 		=> '',
			'current' 		=> max( 1, $curent),
			'total' 		=> $pages,
			'prev_text' => $prev,
			'next_text' => $next,
			'type'			=> 'list',
			'end_size'		=> 2,
			'mid_size'		=> 1
	);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination-list">', $return );
	echo "<p>".esc_html__('Page','hotmagazine')." ".$curent." of ".$pages."</p>";
}

//Custom comment List:
function hotmagazine_theme_comment($comment, $args, $depth) {
	
     $GLOBALS['comment'] = $comment; ?>
     <!--=======  COMMENTS =========-->
     <li <?php comment_class(''); ?> id="comment-<?php comment_ID() ?>" >
		<div class="comment-box">
			<?php if($comment->user_id!='0' and get_user_meta($comment->user_id, '_hotmagazine_avatar' ,true)!=''){ ?>
				<?php $image = get_user_meta($comment->user_id, '_hotmagazine_avatar' ,true); ?>
				<img src="<?php echo esc_attr($image); ?>" />
			<?php }else{ ?>
				<?php echo get_avatar($comment); ?>
			<?php } ?>
			<div class="comment-content">
				<h4><?php printf(esc_html__('%s','hotmagazine'), get_comment_author_link()) ?> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></h4>
				<span><i class="fa fa-clock-o"></i><?php printf(esc_html__('%1$s at %2$s','hotmagazine'), get_comment_date(), get_comment_time()) ?></span>
				<?php comment_text() ?>
				 <?php if ($comment->comment_approved == '0') : ?>
				 <em><?php esc_html_e('Your comment is awaiting moderation.','hotmagazine') ?></em>
				 <br />
			 <?php endif; ?>
			</div>
		</div>
	 
	 
<?php

}

function hotmagazine_bbp_no_breadcrumb ($param) {

return true;

}



add_filter ('bbp_no_breadcrumb', 'hotmagazine_bbp_no_breadcrumb');

// Remove Redux Ads
function hotmagazine_admin_styles() {
?>
<style type="text/css">
.rAds, .rAds span, .rAds div, .redux-notice, .vc_license.activation {
display: none !important;
}
</style>
<?php
}
add_action('admin_head', 'hotmagazine_admin_styles');


add_action( 'cmb2_admin_init', 'hotmagazine_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function hotmagazine_metaboxes() {
	global $hotmagazine_options; 
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_hotmagazine_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'post_options',
        'title'         => esc_html__( 'Post Format Intro', 'hotmagazine' ),
        'object_types'  => array( 'post', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => esc_html__( 'Post Gallery', 'hotmagazine' ),
        'desc'       => esc_html__( 'Upload post images for intro slider', 'hotmagazine' ),
        'id'         => $prefix . 'gallery',
        'type'       => 'file_list',
       
    ) );

   $cmb->add_field(  array(
        'name' => 'oembed URL for post format video',
        'desc' => 'Set Intro video, audio',
        'id'   => $prefix . 'intro_video',
        'type'    => 'oembed',
        
    ));


    // URL text field
    $cmb->add_field( array(
        'name' => esc_html__( 'Intro Caption', 'hotmagazine' ),
        'desc' => esc_html__( 'Post Caption', 'hotmagazine' ),
        'id'   => $prefix . 'caption',
        'type' => 'text',
       
    ) );
    if($hotmagazine_options['body_style']!='' and $hotmagazine_options['body_style']=='game' ){
	    // URL text field
	    $cmb->add_field( array(
	        'name' => esc_html__( 'Post Score Number', 'hotmagazine' ),
	        'desc' => esc_html__( 'Example "9.2"', 'hotmagazine' ),
	        'id'   => $prefix . 'score',
	        'type' => 'text',
	       
	    ) );

	    // URL text field
	    $cmb->add_field( array(
	        'name' => esc_html__( 'Post Score Text', 'hotmagazine' ),
	        'desc' => esc_html__( 'Example "Good"', 'hotmagazine' ),
	        'id'   => $prefix . 'score_text',
	        'type' => 'text',
	       
	    ) );
	}

	$group_field_id = $cmb->add_field( array(
	    'id'          => 'post_review',
	    'type'        => 'group',
	    'description' => __( 'Reviewer overview', 'cmb2' ),
	    // 'repeatable'  => false, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	        'add_button'    => __( 'Add Another Entry', 'cmb2' ),
	        'remove_button' => __( 'Remove Entry', 'cmb2' ),
	        'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );

	// Id's for group's fields only need to be unique for the group. Prefix is not needed.
	$cmb->add_group_field( $group_field_id, array(
	    'name' => 'Entry Title',
	    'id'   => $prefix .'review_title',
	    'type' => 'text',
	    // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb->add_group_field( $group_field_id, array(
	    'name' => 'Description',
	    'description' => 'Note: The Score range is between 0 and 10',
	    'id'   => $prefix .'review_core',
	    'type' => 'text',
	) );

	$cmb->add_field( array(
        'name' => esc_html__( 'Review Description', 'hotmagazine' ),
        'desc' => '',
        'id'   => $prefix . 'review_dsc',
        'type' => 'textarea',
       
	));
     $cmb = new_cmb2_box( array(
        'id'            => 'post_setting',
        'title'         => esc_html__( 'Post Options', 'hotmagazine' ),
        'object_types'  => array( 'post', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        
    ) );

     $cmb->add_field(
     	array(
			    'name' => 'Featured Post',
			    'desc' => '',
			    'id' => $prefix . 'featured',
			    'type' => 'checkbox'
			)
     );

     $cmb->add_field(
     	array(
			    'name' => 'Sticker Post',
			    'desc' => '',
			    'id' => $prefix . 'sticker',
			    'type' => 'checkbox'
			)
     );

     $cmb->add_field(
     	array(
			    'name' => 'Top Stories',
			    'desc' => '',
			    'id' => $prefix . 'stories',
			    'type' => 'checkbox'
			)
     );

     $cmb->add_field(
     	array(
			    'name' => 'Top Carousel',
			    'desc' => '',
			    'id' => $prefix . 'top',
			    'type' => 'checkbox'
			)
     );

     $cmb->add_field( array(
		'name'             => esc_html__( 'Single Post Layout Style', 'hotmagazine' ),
		'desc'             => esc_html__( 'Select your Single Style', 'hotmagazine' ),
		'id'               => $prefix . 'single_type',
		'type'             => 'select',
		
		'options'          => array(
			'standard' => esc_html__( 'Default', 'hotmagazine' ),
			'introtop' => esc_html__( 'Intro on top', 'hotmagazine' ),
			'fullbanner'   => esc_html__( 'Banner Fullwidth', 'hotmagazine' ),
			'fullwidth'     => esc_html__( 'Single Fullwidth', 'hotmagazine' ),
			'bothsidebar'     => esc_html__( ' Both Sidebar', 'hotmagazine' ),
		),
	) );

    $cmb = new_cmb2_box( array(
        'id'            => 'user_edit',
        'title'         => esc_html__( 'User Meta Profile', 'hotmagazine' ),
        'object_types'  => array( 'user', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        
    ) );
    $cmb->add_field(
    	array(
				'name'    => esc_html__( 'Avatar', 'hotmagazine' ),
				'desc'    => esc_html__( 'field description (optional)', 'hotmagazine' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			)
    );
    $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Facebook', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Facebook Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_facebook',
				'type'     => 'text',
				'on_front' => false,
			)
    );
 	$cmb->add_field(
    	
		array(
				'name'     => esc_html__( 'Google', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Google Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_google',
				'type'     => 'text',
				'on_front' => false,
			)
    );
     $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Twitter', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Twitter Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_twitter',
				'type'     => 'text',
				'on_front' => false,
			)
    );
      $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Youtube', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Youtube Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_youtube',
				'type'     => 'text',
				'on_front' => false,
			)
    );
       $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Linkedin', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Linkedin Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_linkedin',
				'type'     => 'text',
				'on_front' => false,
			)
    );
        $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Instagram', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Instagram Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_instagram',
				'type'     => 'text',
				'on_front' => false,
			)
    );
         $cmb->add_field(
    	array(
				'name'     => esc_html__( 'Dribbble', 'hotmagazine' ),
				'desc'     => esc_html__( 'Your Dribbble Link (optional)', 'hotmagazine' ),
				'id'       => $prefix . 'user_dribble',
				'type'     => 'text',
				'on_front' => false,
			)
    );

    $cmb = new_cmb2_box( array(
        'id'            => 'page_options',
        'title'         => esc_html__( 'Page Options', 'hotmagazine' ),
        'object_types'  => array( 'page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        
    ) );
    $cmb->add_field( array(
	    'name'    => 'Menu Item color',
	    'id'      => 'menu_color',
	    'type'    => 'colorpicker',
	    'default' => '#ffffff',
	) );
}


// function to display number of posts.
function hotmagazine_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count.'';
}
 
// function to count views.
function hotmagazine_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'hotmagazine_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function hotmagazine_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
             // This is an example of how to include a plugin from a private repo in your theme.

		array(            
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => 'http://qkthemes.net/plugins/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
		
		array(            
            'name'               => 'QK Register Post Type', // The plugin name.
            'slug'               => 'qk-post_type', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/framework/plugins/qk-post_type.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),array(            
            'name'               => 'Menu Item Custom Fields', // The plugin name.
            'slug'               => 'wp-menu-item-custom-fields', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/framework/plugins/wp-menu-item-custom-fields.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(            
            'name'               => 'QK Import', // The plugin name.
            'slug'               => 'qk-import', // The plugin slug (typically the folder name).
            'source'             => 'http://qkthemes.net/plugins/qk-import.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		
        array(
            'name'      => 'MailChimp for WordPress Lite',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
        ),array(
            'name'      => 'Rating-Widget: Star Review System',
            'slug'      => 'rating-widget',
            'required'  => false,
        ),
        array(
            'name'      => 'bbPress',
            'slug'      => 'bbpress',
            'required'  => false,
        ),
        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
        ),array(
            'name'      => 'CMB2',
            'slug'      => 'cmb2',
            'required'  => true,
        ),array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => 'Menu Icons',
            'slug'      => 'menu-icons',
            'required'  => false,
        ),array(
            'name'      => 'Advanced Category Template',
            'slug'      => 'advanced-category-template',
            'required'  => true,
        ),
		
		
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'hotmagazine' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'hotmagazine' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'hotmagazine' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'hotmagazine' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'hotmagazine' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'hotmagazine' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'hotmagazine' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'hotmagazine' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'hotmagazine' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'hotmagazine' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'hotmagazine' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}

function hotmagazine_insert_image_src_rel_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://placehold.it/350x150"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'hotmagazine_insert_image_src_rel_in_head', 5 );


/** Add Colorpicker Field to "Add New Category" Form **/
function hotmagazine_category_form_custom_field_add( $taxonomy ) {
?>
<div class="form-field">
    <label for="category_custom_color">Color</label>
    <input name="cat_meta[catBG]" class="colorpicker" type="text" value="" />
    <p class="description">Pick a Category Color</p>
</div>
<?php
}
add_action('category_add_form_fields', 'hotmagazine_category_form_custom_field_add', 10 );

/** Add New Field To Category **/
function hotmagazine_extra_category_fields( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id" );
?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="meta-color"><?php _e('Category Name Background Color'); ?></label></th>
    <td>
        <div id="colorpicker">
            <input type="text" name="cat_meta[catBG]" class="colorpicker" size="3" style="width:20%;" value="<?php echo (isset($cat_meta['catBG'])) ? $cat_meta['catBG'] : '#fff'; ?>" />
        </div>
            <br />
        <span class="description"><?php _e(''); ?></span>
            <br />
        </td>
</tr>
<?php
}
add_action('category_edit_form_fields','hotmagazine_extra_category_fields');

/** Save Category Meta **/
function hotmagazine_save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['cat_meta'][$key])){
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
add_action ('edited_category', 'hotmagazine_save_extra_category_fileds');
add_action('created_category', 'hotmagazine_save_extra_category_fileds', 11, 1);


/** Enqueue Color Picker **/
function hotmagazine_colorpicker_enqueue() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'colorpicker-js', get_template_directory_uri() . '/js/colorpicker.js', array( 'wp-color-picker' ) );
}
add_action('admin_enqueue_scripts', 'hotmagazine_colorpicker_enqueue' );

function hotmagazine_wpa_category_nav_class( $classes, $item ){
    if( 'category' == $item->object ){
        $category = get_category( $item->object_id );
        $classes[] = 'category-' . $category->slug;
    }elseif( 'page' == $item->object ){
        $classes[] = 'page-' . $item->object_id;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'hotmagazine_wpa_category_nav_class', 10, 2 );

add_action('wp_head','hotmagazine_category_css');

function hotmagazine_category_css() { ?>
	<?php global $hotmagazine_options; ?>

	<style> 
		<?php $categories = get_terms('category' , 'hide_empty=0'); ?>
		<?php foreach ($categories as $category) { 
			$cat_id = $category->term_id;
			$cat_slug = $category->slug;
		    $cat_data = get_option("category_$cat_id"); ?>
		    <?php if($cat_data['catBG']!='' and $cat_data['catBG']!='#ffffff'){ ?>
		    <?php if($hotmagazine_options['body_style']=='default' or $hotmagazine_options['body_style']=='boxed' or $hotmagazine_options['body_style']=='dark' or $hotmagazine_options['body_style']=='sport'){ ?>
		    .navbar-nav > li.category-<?php echo $cat_slug; ?> > a:before,a.category-post.<?php echo $cat_slug; ?>{
			    background: <?php  echo $cat_data['catBG']; ?>;
			}
			
			<?php } ?>
			
			.navbar-nav .megadropdown .<?php echo $cat_slug; ?>-dropdown{
				border-top-color: <?php  echo $cat_data['catBG']; ?>;
			}
			.standard-post3 .post-title a.category-post.<?php echo $cat_slug; ?>{
				color: <?php  echo $cat_data['catBG']; ?>;
			}
		    <?php } ?>
		    .navbar-nav .category-<?php echo $cat_slug; ?> .megadropdown .inner-megadropdown{
		    	border-top-color: <?php  echo $cat_data['catBG']; ?>;
		    }
		<?php } ?>
		<?php 
		$page_ids=get_all_page_ids();
		foreach($page_ids as $page){

			$page_color = get_post_meta($page, 'menu_color', true);
			
			if($page_color !='' and $page_color!='#ffffff'){ ?>
				.navbar-nav > li.page-<?php echo $page; ?> > a:before{
				    background: <?php  echo $page_color; ?> !important;
				}
			<?php }
		}

		?>
	</style>

	
<?php 
}

//Register Form

class Designmodo_registration_form
{

    private $username;
    private $email;
    private $password;
    private $repassword;

    function __construct()
    {

        add_shortcode('dm_registration_form', array($this, 'shortcode'));
    }


    public function registration_form()
    {

        ?>

        <form class="register-form" name="registerform" id="registerform" method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
        		<div class="title-section">
				<h1><span>Register</span></h1>
			</div>
                <div class="form-group">
                	<label class="login-field-icon fui-user" for="reg-name"><?php esc_html_e('Your Username','hotmagazine'); ?><span>*</span></label>
                    <input name="reg_name" type="text" class="login-field"
                           value="<?php echo(isset($_POST['reg_name']) ? $_POST['reg_name'] : null); ?>"
                            id="reg-name" required/>
                    
                </div>

                <div class="form-group">
                	<label class="login-field-icon fui-mail" for="reg-email"><?php esc_html_e('Your Email Adress','hotmagazine'); ?><span>*</span></label>
                    <input name="reg_email" type="email" class="login-field"
                           value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>"
                            id="reg-email" required/>
                    
                </div>

                <div class="form-group">
                	<label class="login-field-icon fui-lock" for="reg-pass"><?php esc_html_e('Your Password','hotmagazine'); ?><span>*</span></label>
                    <input name="reg_password" type="password" class="login-field"
                           value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>"
                            id="reg-pass" required/>
                    
                </div>
                <div class="form-group">
                	<label class="login-field-icon fui-lock" for="reg-repass"><?php esc_html_e('Confirm Password','hotmagazine'); ?><span>*</span></label>
                    <input name="reg_repassword" type="password" class="login-field"
                           value="<?php echo(isset($_POST['reg_repassword']) ? $_POST['reg_repassword'] : null); ?>"
                           placeholder="Password" id="reg-repass" required/>
                    
                </div>

               

                <input class="btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="Register"/>
                <p class="login-line"><?php esc_html_e('Back to','hotmagazine'); ?> <a href="#"><?php esc_html_e('Login','hotmagazine'); ?></a></p>
        </form>
<?php
    }

    function validation()
    {

        if (empty($this->username) || empty($this->password) || empty($this->email)) {
            return new WP_Error('field', 'Required form field is missing');
        }

        if (strlen($this->username) < 4) {
            return new WP_Error('username_length', 'Username too short. At least 4 characters is required');
        }

        if (strlen($this->password) < 5) {
            return new WP_Error('password', 'Password length must be greater than 5');
        }

        if (!is_email($this->email)) {
            return new WP_Error('email_invalid', 'Email is not valid');
        }

        if (email_exists($this->email)) {
            return new WP_Error('email', 'Email Already in use');
        }

        if ($this->password!=$this->repassword) {
            return new WP_Error('password', 'Your Password not correct. Please check again!!!');
        }

        $details = array('Username' => $this->username,
            
        );

        foreach ($details as $field => $detail) {
            if (!validate_username($detail)) {
                return new WP_Error('name_invalid', 'Sorry, the "' . $field . '" you entered is not valid');
            }
        }

    }

    function registration()
    {

        $userdata = array(
            'user_login' => esc_attr($this->username),
            'user_email' => esc_attr($this->email),
            'user_pass' => esc_attr($this->password),
           
        );

        if (is_wp_error($this->validation())) {
            echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
            echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
            echo '</div>';
        } else {
            $register_user = wp_insert_user($userdata);
            if (!is_wp_error($register_user)) {

            		if ( !is_user_logged_in() ) {
            			echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-success">Login With Your account registered </div>';
					}
                
            } else {
                echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
                echo '<strong>' . $register_user->get_error_message() . '</strong>';
                echo '</div>';
            }
        }

    }

    

    function shortcode()
    {

        ob_start();

        if (isset($_POST['reg_submit'])) {
            $this->username = $_POST['reg_name'];
            $this->email = $_POST['reg_email'];
            $this->password = $_POST['reg_password'];
            $this->repassword = $_POST['reg_repassword'];

            $this->validation();
            $this->registration();
        }

        $this->registration_form();
        return ob_get_clean();
    }

}

new Designmodo_registration_form;
?>