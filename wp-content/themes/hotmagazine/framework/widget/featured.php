<?php

// Creating the widget 
class recent_post_widget extends WP_Widget {

function __construct() {

parent::__construct(
// Base ID of your widget
'recent_post_widget', 

// Widget name will appear in UI
esc_html__('QK Featured Posts', 'hotmagazine'), 

// Widget description
array( 'description' => esc_html__( 'Listing RECENT Posts', 'hotmagazine' ), ) 
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

<div class=" features-slide-widget">
	
	<div class="image-post-slider">
		<ul class="bxslider">
			<?php 
		
				$arr = array('post_type' => 'post', 'posts_per_page' => $instance['count'],'meta_query' => array(
						array(
							'key'     => '_hotmagazine_featured',
							'value'   => 'on',
							'compare' => 'IN',
						),
			));
				$query = new WP_Query($arr);
				while($query->have_posts()) : $query->the_post();
			?>
			<li>
				<div class="news-post image-post2">
					<?php the_post_thumbnail(); ?>
					<div class="hover-box">
						<div class="inner-hover">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
								<li><i class="fa fa-user"></i><?php esc_html_e('by','hotmagazine'); ?> <?php the_author_posts_link(); ?></li>
								<li> <?php comments_popup_link('<i class="fa fa-comments-o"></i><span>0</span> ','<i class="fa fa-comments-o"></i><span>1</span>','<i class="fa fa-comments-o"></i><span>%</span>','comm'); ?></li>
								
							</ul>
						</div>
					</div>
				</div>
			</li>
			<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
		</ul>
	</div>
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
$title = esc_html__( 'Featured Posts', 'hotmagazine' );
//$count = 4;
}
if ( isset( $instance[ 'count' ] ) ) {
$count = $instance[ 'count' ];
}
else {
$count = 3;
//$count = 4;
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

// Register and load the widget
function wpb_load_widget3() {
	register_widget( 'recent_post_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget3' );
?>