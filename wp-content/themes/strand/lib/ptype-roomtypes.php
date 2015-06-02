<?php
// ptype_room_types Custom Post Type
add_action( 'init', 'ptype_room_types_post_type' );
function ptype_room_types_post_type() {
	register_post_type( 'ptype_room_types',
		array(
			'labels' => array(
				'name' => __( 'Room Types', 'theme' ),
				'singular_name' => __( 'Room Types', 'theme' ),
				'add_new' =>  __( 'Add New Room Type', 'theme' ),
				'add_new_item' =>  __( 'Add New Room Type', 'theme' ),
				'edit_item' =>  __( 'Edit Room Type', 'theme' ),
				'new_item' =>  __( 'New Room Type', 'theme' ),
				'all_items' =>  __( 'All Room Types', 'theme' ),
				'view_item' =>  __( 'View Room Type', 'theme' ),
				'search_items' =>  __( 'Search Room Type', 'theme' ),
				'not_found' =>   __( 'No Room Type found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Room Type found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Room Types', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'room_types', 'with_front' => true ),
		'menu_icon' => 'dashicons-grid-view',  // Icon Path
		)
	);
}

add_taxonomy('roomtype', 'ptype_room_types', array(
    'labels' => array('add_new_item' => 'Add New Page','name'=>'Room Type')
));

// MetaBox
add_action( 'admin_init', 'ptype_room_types_register_meta_box' );
function ptype_room_types_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_room_types_';
    $meta_box = array(
		'id' => 'rooms-suites',
		'title' => 'Rooms & Suites',
		'pages' => array( 'ptype_room_types' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(
				'name' => 'Heading H2',
				'desc' => '',
				'id' => $prefix . 'heading_h2',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Heading H3',
				'desc' => '',
				'id' => $prefix . 'heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'heading_paragraph_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Check Availability H4',
				'desc' => '',
				'id' => $prefix . 'check_availability_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Check Availability H3',
				'desc' => '',
				'id' => $prefix . 'check_availability_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Room Rate P',
				'desc' => '',
				'id' => $prefix . 'room_rate_p',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Room Info Heading H3',
				'desc' => '',
				'id' => $prefix . 'room_info_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Room Info Content HTML',
				'desc' => '',
				'id' => $prefix . 'room_info_content_HTML',
				'type' => 'textarea'
			),

			array(
				'name' => 'Room Feature Heading H3',
				'desc' => '',
				'id' => $prefix . 'room_feature_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Room Feature Images',
				'desc' => '',
				'id' => $prefix . 'room_feature_images',
				'type' => 'image_advanced'
			),

			array(
				'name' => 'Room Feature Images Caption',
				'desc' => '',
				'id' => $prefix . 'room_feature_images_caption',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Room Feature Detail Heading H3',
				'desc' => '',
				'id' => $prefix . 'room_feature_detail_heading_h3',
				'type' => 'text',
				'std' => ''
			)
		)
	);
    new RW_Meta_Box( $meta_box );
}

// Add a new column for the order
function add_new_ptype_room_types_column($ptype_room_types_columns) {
  $ptype_room_types_columns['menu_order'] = "Order";
  return $ptype_room_types_columns;
}
add_action('manage_edit-ptype_room_types_columns', 'add_new_ptype_room_types_column');

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
// add_action('manage_ptype_room_types_posts_custom_column','show_order_column_events');

// // Set the column to be sortable
// function order_column_register_sortable_events($columns){
//   $columns['menu_order'] = 'menu_order';
//   return $columns;
// }
// add_filter('manage_edit-ptype_room_types_sortable_columns','order_column_register_sortable_events');
?>