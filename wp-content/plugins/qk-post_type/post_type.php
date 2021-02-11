<?php 
/**
 * Plugin Name: QK Register Post Type
 * Description: This plugin register all post type come with theme.
 * Version: 1.0
 * Author: Quannt
 * Author URI: http://qkthemes.com
 */
?>
<?php


//Megamenu

add_action( 'init', 'codex_megamenu_init' );
/**
 * Register a Lookbook post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_megamenu_init() {
	
	
	$labels = array(
		'name'               => __( 'Megamenus', 'post type general name', 'qktheme' ),
		'singular_name'      => __( 'Megamenu', 'post type singular name', 'qktheme' ),
		'menu_name'          => __( 'Megamenus', 'admin menu', 'qktheme' ),
		'name_admin_bar'     => __( 'Megamenu', 'add new on admin bar', 'qktheme' ),
		'add_new'            => __( 'Add New', 'Megamenu', 'qktheme' ),
		'add_new_item'       => __( 'Add New Megamenu', 'qktheme' ),
		'new_item'           => __( 'New Megamenu', 'qktheme' ),
		'edit_item'          => __( 'Edit Megamenu', 'qktheme' ),
		'view_item'          => __( 'View Megamenu', 'qktheme' ),
		'all_items'          => __( 'All Megamenus', 'qktheme' ),
		'search_items'       => __( 'Search Megamenus', 'qktheme' ),
		'parent_item_colon'  => __( 'Parent Megamenu:', 'qktheme' ),
		'not_found'          => __( 'No Megamenus found.', 'qktheme' ),
		'not_found_in_trash' => __( 'No Megamenus found in Trash.', 'qktheme' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-screenoptions',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'megamenu' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'megamenu', $args );
}

?>