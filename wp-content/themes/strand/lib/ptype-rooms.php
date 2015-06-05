<?php
// ptype_rooms Custom Post Type
add_action( 'init', 'ptype_rooms_post_type' );
function ptype_rooms_post_type() {
	register_post_type( 'ptype_rooms',
		array(
			'labels' => array(
				'name' => __( 'Room Sections', 'theme' ),
				'singular_name' => __( 'Room Section', 'theme' ),
				'add_new' =>  __( 'Add New Section', 'theme' ),
				'add_new_item' =>  __( 'Add New Section', 'theme' ),
				'edit_item' =>  __( 'Edit Section', 'theme' ),
				'new_item' =>  __( 'New Section', 'theme' ),
				'all_items' =>  __( 'All Sections', 'theme' ),
				'view_item' =>  __( 'View Section', 'theme' ),
				'search_items' =>  __( 'Search Section', 'theme' ),
				'not_found' =>   __( 'No Section found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Section found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Room Sections', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'event', 'with_front' => true ),
		'menu_icon' => 'dashicons-grid-view',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_rooms_register_meta_box' );
function ptype_rooms_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_rooms_';
    $meta_box = array(
			'id' => 'rooms-suites',
			'title' => 'Rooms & Suites',
			'pages' => array( 'ptype_rooms' ),
			'context' => 'normal',
			'priority' => 'core',
			'fields' => array(			
					array(
						'name' => 'Section ID',
						'desc' => '',
						'id' => $prefix . 'section_id',
						'type' => 'text',
						'std' => '',
					),								
					
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
						'name' => 'Slider Images',
						'desc' => '',
						'id' => $prefix . 'slider_images',
						'type' => 'image_advanced'
					),

					array(
						'name' => 'Ultimate experience Icon',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_icon',
						'type' => 'image_advanced',
						'max_file_uploads' => 1
					),

					array(
						'name' => 'Ultimate experience Images HTML',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_img_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Ultimate experience Images',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_img',
						'type' => 'image_advanced'
					),

					array(
						'name' => 'Ultimate experience Images HTML 2',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_img_html_2',
						'type' => 'textarea'
					),

					array(
						'name' => 'Ultimate experience Heading H3',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_heading_h3',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Ultimate experience Heading H4',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_heading_h4',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Ultimate experience Paragraph P',
						'desc' => '',
						'id' => $prefix . 'ultimate_experience_paragraph_p',
						'type' => 'textarea',
						'std' => ''
					),
				)
			);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
			'id' => 'available-rooms',
			'title' => 'Available Rooms',
			'pages' => array( 'ptype_rooms' ),
			'context' => 'normal',
			'priority' => 'core',
			'fields' => array(
					array(
						'name' => 'Section ID',
						'desc' => '',
						'id' => $prefix . 'section_id',
						'type' => 'text',
						'std' => '',
					),
					
					array(
						'name' => 'Room 1 Image',
						'desc' => '',
						'id' => $prefix . 'room_1_img',
						'type' => 'image_advanced',
						'max_file_uploads' => 1
					),

					array(
						'name' => 'Room 1 Image HTML',
						'desc' => '',
						'id' => $prefix . 'room_1_img_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Room 1 Link Text',
						'desc' => '',
						'id' => $prefix . 'room_1_link_text',
						'type' => 'text',
						'std' => ''
					),
					
					array(
						'name' => 'Room 1 Link',
						'desc' => '',
						'id' => $prefix . 'room_1_link',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Room 2 Image',
						'desc' => '',
						'id' => $prefix . 'room_2_img',
						'type' => 'image_advanced',
						'max_file_uploads' => 1
					),

					array(
						'name' => 'Room 2 Image HTML',
						'desc' => '',
						'id' => $prefix . 'room_2_img_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Room 2 Link Text',
						'desc' => '',
						'id' => $prefix . 'room_2_link_text',
						'type' => 'text',
						'std' => ''
					),
					
					array(
						'name' => 'Room 2 Link',
						'desc' => '',
						'id' => $prefix . 'room_2_link',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Room 3 Image',
						'desc' => '',
						'id' => $prefix . 'room_3_img',
						'type' => 'image_advanced',
						'max_file_uploads' => 1
					),

					array(
						'name' => 'Room 3 Image HTML',
						'desc' => '',
						'id' => $prefix . 'room_3_img_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Room 3 Link Text',
						'desc' => '',
						'id' => $prefix . 'room_3_link_text',
						'type' => 'text',
						'std' => ''
					),
					
					array(
						'name' => 'Room 3 Link',
						'desc' => '',
						'id' => $prefix . 'room_3_link',
						'type' => 'text',
						'std' => ''
					),
				)
			);

	new RW_Meta_Box( $meta_box_2 );
}

// Add a new column for the order
function add_new_ptype_rooms_column($ptype_rooms_columns) {
  $ptype_rooms_columns['menu_order'] = "Order";
  return $ptype_rooms_columns;
}
add_action('manage_edit-ptype_rooms_columns', 'add_new_ptype_rooms_column');

// Render the column values
function show_order_column_events($name){
  global $post;

  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_ptype_rooms_posts_custom_column','show_order_column_events');

// Set the column to be sortable
function order_column_register_sortable_events($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-ptype_rooms_sortable_columns','order_column_register_sortable_events');
?>