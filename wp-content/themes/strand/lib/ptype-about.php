<?php
// ptype_about Custom Post Type
add_action( 'init', 'ptype_about_post_type' );
function ptype_about_post_type() {
	register_post_type( 'ptype_about',
		array(
			'labels' => array(
				'name' => __( 'About Sections', 'theme' ),
				'singular_name' => __( 'About Section', 'theme' ),
				'add_new' =>  __( 'Add New About Section', 'theme' ),
				'add_new_item' =>  __( 'Add New About Section', 'theme' ),
				'edit_item' =>  __( 'Edit About Section', 'theme' ),
				'new_item' =>  __( 'New About Section', 'theme' ),
				'all_items' =>  __( 'All About Sections', 'theme' ),
				'view_item' =>  __( 'View About Section', 'theme' ),
				'search_items' =>  __( 'Search About Section', 'theme' ),
				'not_found' =>   __( 'No About Section found', 'theme' ),
				'not_found_in_trash' =>  __( 'No About Section found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'About Section', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 20,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'about_section', 'with_front' => true ),
		'menu_icon' => 'dashicons-groups',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_about_register_meta_box' );
function ptype_about_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_about_';
    $meta_box = array(
		'id' => 'discover-us',
		'title' => 'Discover Us',
		'pages' => array( 'ptype_about' ),
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
				'name' => 'Heading H4',
				'desc' => '',
				'id' => $prefix . 'heading_h4',
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
				'name' => 'Heading Quote H4',
				'desc' => '',
				'id' => $prefix . 'heading_quote_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Heading H5',
				'desc' => '',
				'id' => $prefix . 'heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'About Images',
				'desc' => '',
				'id' => $prefix . 'about_images',
				'type' => 'image_advanced'
			)

		)
	);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
		'id' => 'stay-with-us',
		'title' => 'Stay With Us',
		'pages' => array( 'ptype_about' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(
				'name' => 'Book Your Stay Background',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_bg',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Book Your Stay Heading H2',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Book Your Stay Heading H3',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Book Your Stay Paragraph P',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_paragraph_p',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Book Your Stay Link Text',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Book Your Stay Link',
				'desc' => '',
				'id' => $prefix . 'book_your_stay_link',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	new RW_Meta_Box( $meta_box_2 );
}

// Add a new column for the order
function add_new_ptype_about_column($ptype_about_columns) {
  $ptype_about_columns['menu_order'] = "Order";
  return $ptype_about_columns;
}
add_action('manage_edit-ptype_about_columns', 'add_new_ptype_about_column');

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
// add_action('manage_ptype_about_posts_custom_column','show_order_column_events');

// // Set the column to be sortable
// function order_column_register_sortable_events($columns){
//   $columns['menu_order'] = 'menu_order';
//   return $columns;
// }
// add_filter('manage_edit-ptype_about_sortable_columns','order_column_register_sortable_events');
?>