<?php

// Creating the widget 
class random_post_widget extends WP_Widget {

function __construct() {

parent::__construct(
// Base ID of your widget
'random_post_widget', 

// Widget name will appear in UI
esc_html__('QK Random Posts', 'hotmagazine'), 

// Widget description
array( 'description' => esc_html__( 'Listing Random Posts', 'hotmagazine' ), ) 
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

<div class=" posts-widget">
  
  <ul class="list-posts">
  
  	<?php 
		
		$arr = array('post_type' => 'post', 'posts_per_page' => $instance['count'],'orderby'=>'rand');
		$query = new WP_Query($arr);
		while($query->have_posts()) : $query->the_post();
	?>
    <li>
      <?php if(has_post_thumbnail()){ ?>
		<?php the_post_thumbnail('small'); ?>
		<?php }else{ ?>
		<img src="http://placehold.it/80x70" />
		<?php } ?>
      	<div class="post-content">
			<?php the_category(', '); ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
			<ul class="post-tags">
				<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
			</ul>
		</div>
      
    </li>
    <?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
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
$title = esc_html__( 'Random Posts', 'hotmagazine' );
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
function wpb_load_widget4() {
	register_widget( 'random_post_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget4' );
?>