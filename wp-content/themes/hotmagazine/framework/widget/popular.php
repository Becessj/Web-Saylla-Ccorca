<?php

// Creating the widget 
class featured_post_widget extends WP_Widget {

function __construct() {

parent::__construct(
// Base ID of your widget
'featured_post_widget', 

// Widget name will appear in UI
esc_html__('QK Posts Tab', 'hotmagazine'), 

// Widget description
array( 'description' => esc_html__( 'Listing POPULAR Posts', 'hotmagazine' ), ) 
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

<div class=" tab-posts-widget">

	<ul class="nav nav-tabs" id="myTab">
		<li class="active">
			<a href="#option1" data-toggle="tab"><?php esc_html_e('Popular','hotmagazine'); ?> </a>
		</li>
		<li>
			<a href="#option2" data-toggle="tab"><?php esc_html_e('Recent','hotmagazine'); ?></a>
		</li>
		<li>
			<a href="#option3" data-toggle="tab"><?php esc_html_e('Top Reviews','hotmagazine'); ?></a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="option1">
			<ul class="list-posts">
				
				<?php 
				
					$arr = array('post_type' => 'post', 'posts_per_page' => $instance['count'], 'meta_key' => 'post_views_count', 'orderby' => 'meta_value', 'order' => 'DESC',);
					$popular = new WP_Query($arr);
					while($popular->have_posts()) : $popular->the_post();
				?>

				<li>
					<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail('small'); ?>
					<?php }else{ ?>
					<img src="http://placehold.it/80x70" />
					<?php } ?>
					<div class="post-content">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						</ul>
					</div>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<div class="tab-pane" id="option2">
			<ul class="list-posts">

				<?php 
				
					$arr = array('post_type' => 'post', 'posts_per_page' => $instance['count']);
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
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						</ul>
					</div>
				</li>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>										
		</div>
		<div class="tab-pane" id="option3">
			<ul class="list-posts">

				<?php 
				
					$arr = array('post_type' => 'post', 'posts_per_page' => $instance['count'], 'orderby' => 'comment_count');
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
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-clock-o"></i><?php the_time(get_option( 'date_format' )); ?></li>
						</ul>
					</div>
				</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>										
		</div>
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
$title = esc_html__( 'POPULAR POSTS', 'hotmagazine' );
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
function wpb_load_widget2() {
	register_widget( 'featured_post_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget2' );
?>