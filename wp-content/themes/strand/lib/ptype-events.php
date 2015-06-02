<?php
// ptype_events Custom Post Type
add_action( 'init', 'ptype_events_post_type' );
function ptype_events_post_type() {
	register_post_type( 'ptype_events',
		array(
			'labels' => array(
				'name' => __( 'Events', 'theme' ),
				'singular_name' => __( 'Event', 'theme' ),
				'add_new' =>  __( 'Add New Event', 'theme' ),
				'add_new_item' =>  __( 'Add New Event', 'theme' ),
				'edit_item' =>  __( 'Edit Event', 'theme' ),
				'new_item' =>  __( 'New Event', 'theme' ),
				'all_items' =>  __( 'All Events', 'theme' ),
				'view_item' =>  __( 'View Event', 'theme' ),
				'search_items' =>  __( 'Search Event', 'theme' ),
				'not_found' =>   __( 'No Event found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Event found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Events', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'thumbnail', 'editor' ), 
		'rewrite'  => array( 'slug' => 'event', 'with_front' => true ),
		'menu_icon' => 'dashicons-calendar',  // Icon Path
		)
	);
}
?>