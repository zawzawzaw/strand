<?php
// ptype_places Custom Post Type
add_action( 'init', 'ptype_places_post_type' );
function ptype_places_post_type() {
	register_post_type( 'ptype_places',
		array(
			'labels' => array(
				'name' => __( 'Nearby Places', 'theme' ),
				'singular_name' => __( 'Nearby Places', 'theme' ),
				'add_new' =>  __( 'Add New Nearby Place', 'theme' ),
				'add_new_item' =>  __( 'Add New Nearby Place', 'theme' ),
				'edit_item' =>  __( 'Edit Nearby Place', 'theme' ),
				'new_item' =>  __( 'New Nearby Place', 'theme' ),
				'all_items' =>  __( 'All Nearby Places', 'theme' ),
				'view_item' =>  __( 'View Nearby Place', 'theme' ),
				'search_items' =>  __( 'Search Nearby Place', 'theme' ),
				'not_found' =>   __( 'No Nearby Place found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Nearby Place found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Nearby Places', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 5,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'nearby_places', 'with_front' => true ),
		'menu_icon' => 'dashicons-location',  // Icon Path
		)
	);
}

add_taxonomy('placetype', 'ptype_places', array(
    'labels' => array('add_new_item' => 'Add New Page','name'=>'Place Type')
));

// MetaBox
add_action( 'admin_init', 'ptype_places_register_meta_box' );
function ptype_places_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_places_';
    $meta_box = array(
			'id' => 'places',
			'title' => 'Feature Places',
			'pages' => array( 'ptype_places' ),
			'context' => 'normal',
			'priority' => 'core',
			'fields' => array(														
					
					array(
						'name' => 'Place Name',
						'desc' => '',
						'id' => $prefix . 'place_name_heading_h2',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Feature Place?',
						'desc' => '',
						'id' => $prefix . 'feature_place',
						'type' => 'checkbox',
						'std' => ''
					),					

					array(
						'name' => 'Feature Title Heading H3',
						'desc' => '',
						'id' => $prefix . 'feature_title_heading_h3',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Place Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'place_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Place Website Link Text',
						'desc' => '',
						'id' => $prefix . 'place_website_link_text',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Place Website Link',
						'desc' => '',
						'id' => $prefix . 'place_website_link',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Place Location Link Text',
						'desc' => '',
						'id' => $prefix . 'place_location_link_text',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Place Location Link',
						'desc' => '',
						'id' => $prefix . 'place_location_link',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Place Image',
						'desc' => '',
						'id' => $prefix . 'place_image',
						'type' => 'image_advanced'
					),	

					array(
						'name' => 'Extra Content Image (for feature place only)',
						'desc' => '',
						'id' => $prefix . 'extra_content_image',
						'type' => 'image_advanced'
					),

					array(
						'name' => 'Extra Content Paragraph HTML (for feature place only)',
						'desc' => '',
						'id' => $prefix . 'extra_content_paragraph_html',
						'type' => 'textarea'
					),
				)
			);
    new RW_Meta_Box( $meta_box );

}

// Add a new column for the order
function add_new_ptype_places_column($ptype_places_columns) {
  $ptype_places_columns['menu_order'] = "Order";
  return $ptype_places_columns;
}
add_action('manage_edit-ptype_places_columns', 'add_new_ptype_places_column');

// Render the column values
// function show_order_column_events($name){
//   global $post;

//   switch ($name) {
//     case 'menu_order':
//       $order = $post->menu_order;
//       echo $order;
//       break;
//    default:
//       break;
//    }
// }
// add_action('manage_ptype_places_posts_custom_column','show_order_column_events');

// // Set the column to be sortable
// function order_column_register_sortable_events($columns){
//   $columns['menu_order'] = 'menu_order';
//   return $columns;
// }
// add_filter('manage_edit-ptype_places_sortable_columns','order_column_register_sortable_events');
?>