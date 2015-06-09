<?php
// ptype_amenities Custom Post Type
add_action( 'init', 'ptype_amenities_post_type' );
function ptype_amenities_post_type() {
	register_post_type( 'ptype_amenities',
		array(
			'labels' => array(
				'name' => __( 'Amenities Sections', 'theme' ),
				'singular_name' => __( 'Amenities Section', 'theme' ),
				'add_new' =>  __( 'Add New Amenities Section', 'theme' ),
				'add_new_item' =>  __( 'Add New Amenities Section', 'theme' ),
				'edit_item' =>  __( 'Edit Amenities Section', 'theme' ),
				'new_item' =>  __( 'New Amenities Section', 'theme' ),
				'all_items' =>  __( 'All Amenities Sections', 'theme' ),
				'view_item' =>  __( 'View Amenities Section', 'theme' ),
				'search_items' =>  __( 'Search Amenities Section', 'theme' ),
				'not_found' =>   __( 'No Amenities Section found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Amenities Section found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Amenities Section', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'about_section', 'with_front' => true ),
		'menu_icon' => 'dashicons-tag',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_amenities_register_meta_box' );
function ptype_amenities_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_amenities_';
    $meta_box = array(
		'id' => 'first-section',
		'title' => 'First Section',
		'pages' => array( 'ptype_amenities' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(							
			
			array(
				'name' => 'Heading H2',
				'desc' => '',
				'id' => $prefix . 'dinning_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading H3',
				'desc' => '',
				'id' => $prefix . 'dinning_heading_h3',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Heading H5 ',
				'desc' => '',
				'id' => $prefix . 'dinning_heading_h5',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'dinning_paragraph_html',
				'type' => 'textarea'
			),			
			
			array(
				'name' => 'Image',
				'desc' => '',
				'id' => $prefix . 'dinning_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Extra Content Image',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_img',
				'type' => 'image_advanced'
			),

			array(
				'name' => 'Extra Content 1 Heading h5',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_1_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Extra Content 1 HTML',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_1_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Extra Content 2 Heading h5',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_2_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Extra Content 2 HTML',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_2_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Extra Content 3 Heading h5',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_3_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Extra Content 3 HTML',
				'desc' => '',
				'id' => $prefix . 'dinning_extra_3_html',
				'type' => 'textarea'
			)

		)
	);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
		'id' => 'second-section',
		'title' => 'Second Section',
		'pages' => array( 'ptype_amenities' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(
				'name' => 'Image',
				'desc' => '',
				'id' => $prefix . 'second_section_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Heading H2',
				'desc' => '',
				'id' => $prefix . 'second_section_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading H3',
				'desc' => '',
				'id' => $prefix . 'second_section_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading H5',
				'desc' => '',
				'id' => $prefix . 'second_section_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'second_section_paragraph_HTML',
				'type' => 'textarea'
			),

		)
	);
	new RW_Meta_Box( $meta_box_2 );

	$meta_box_3 = array(
		'id' => 'third-section',
		'title' => 'Third Section',
		'pages' => array( 'ptype_amenities' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(							
			
			array(
				'name' => 'Heading H2',
				'desc' => '',
				'id' => $prefix . 'third_content_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading H3',
				'desc' => '',
				'id' => $prefix . 'third_content_heading_h3',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Heading H5 ',
				'desc' => '',
				'id' => $prefix . 'third_content_heading_h5',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'third_content_paragraph_html',
				'type' => 'textarea'
			),			
			
			array(
				'name' => 'Image',
				'desc' => '',
				'id' => $prefix . 'third_content_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Extra Content Image',
				'desc' => '',
				'id' => $prefix . 'third_content_extra_img',
				'type' => 'image_advanced'
			),

			array(
				'name' => 'Extra Content Heading h5',
				'desc' => '',
				'id' => $prefix . 'third_content_extra_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Extra Content HTML',
				'desc' => '',
				'id' => $prefix . 'third_content_extra_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Extra Content Images HTML',
				'desc' => '',
				'id' => $prefix . 'third_content_extra_img_html',
				'type' => 'textarea'
			)

		)
	);
    new RW_Meta_Box( $meta_box_3 );


}

// Add a new column for the order
function add_new_ptype_amenities_column($ptype_amenities_columns) {
  $ptype_amenities_columns['menu_order'] = "Order";
  return $ptype_amenities_columns;
}
add_action('manage_edit-ptype_amenities_columns', 'add_new_ptype_amenities_column');

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
// add_action('manage_ptype_amenities_posts_custom_column','show_order_column_events');

// // Set the column to be sortable
// function order_column_register_sortable_events($columns){
//   $columns['menu_order'] = 'menu_order';
//   return $columns;
// }
// add_filter('manage_edit-ptype_amenities_sortable_columns','order_column_register_sortable_events');
?>