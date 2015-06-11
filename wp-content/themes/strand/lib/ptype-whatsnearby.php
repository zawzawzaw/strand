<?php
// ptype_whatsnearby Custom Post Type
add_action( 'init', 'ptype_whatsnearby_post_type' );
function ptype_whatsnearby_post_type() {
	register_post_type( 'ptype_whatsnearby',
		array(
			'labels' => array(
				'name' => __( 'What\'s Nearby Sections', 'theme' ),
				'singular_name' => __( 'What\'s Nearby Section', 'theme' ),
				'add_new' =>  __( 'Add New What\'s Nearby Section', 'theme' ),
				'add_new_item' =>  __( 'Add New What\'s Nearby Section', 'theme' ),
				'edit_item' =>  __( 'Edit What\'s Nearby Section', 'theme' ),
				'new_item' =>  __( 'New What\'s Nearby Section', 'theme' ),
				'all_items' =>  __( 'All What\'s Nearby Sections', 'theme' ),
				'view_item' =>  __( 'View What\'s Nearby Section', 'theme' ),
				'search_items' =>  __( 'Search What\'s Nearby Section', 'theme' ),
				'not_found' =>   __( 'No What\'s Nearby Section found', 'theme' ),
				'not_found_in_trash' =>  __( 'No What\'s Nearby Section found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'What\'s Nearby Section', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 5,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'about_section', 'with_front' => true ),
		'menu_icon' => 'dashicons-location-alt',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_whatsnearby_register_meta_box' );
function ptype_whatsnearby_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_whatsnearby_';
    $meta_box = array(
		'id' => 'first-content',
		'title' => 'First Content',
		'pages' => array( 'ptype_whatsnearby' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(							
			
			array(
				'name' => 'Where To Shop Heading H2',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Where To Shop Heading H3',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_heading_h3',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Where To Shop Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_paragraph_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Where To Shop Link Text',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Where To Shop Link',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_link',
				'type' => 'text',
				'std' => ''
			),
			
			array(
				'name' => 'Where To Shop Image',
				'desc' => '',
				'id' => $prefix . 'where_to_shop_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Explore Attraction Heading H2',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Explore Attraction Heading H3',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_heading_h3',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Explore Attraction Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_paragraph_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Explore Attraction Link Text',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Explore Attraction Link',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_link',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Explore Attraction Background Stamp',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_bg_stamp',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),
			
			array(
				'name' => 'Explore Attraction Image',
				'desc' => '',
				'id' => $prefix . 'explore_attraction_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Eat & Drink Heading H2',
				'desc' => '',
				'id' => $prefix . 'eat_drink_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eat & Drink Heading H3',
				'desc' => '',
				'id' => $prefix . 'eat_drink_heading_h3',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'Eat & Drink Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'eat_drink_paragraph_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Eat & Drink Link Text',
				'desc' => '',
				'id' => $prefix . 'eat_drink_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eat & Drink Link',
				'desc' => '',
				'id' => $prefix . 'eat_drink_link',
				'type' => 'text',
				'std' => ''
			),
			
			array(
				'name' => 'Eat & Drink Image',
				'desc' => '',
				'id' => $prefix . 'eat_drink_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			)

		)
	);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
		'id' => 'neighborhood',
		'title' => 'Neighborhood',
		'pages' => array( 'ptype_whatsnearby' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(

			array(
				'name' => 'Neighborhood Heading H2',
				'desc' => '',
				'id' => $prefix . 'neighborhood_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Neighborhood Heading H3',
				'desc' => '',
				'id' => $prefix . 'neighborhood_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Neighborhood Paragraph HTML',
				'desc' => '',
				'id' => $prefix . 'neighborhood_paragraph_HTML',
				'type' => 'textarea'
			),

			array(
				'name' => 'Shopping Places Heading H4',
				'desc' => '',
				'id' => $prefix . 'shopping_place_heading_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Shopping Places Heading H5',
				'desc' => '',
				'id' => $prefix . 'shopping_place_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Shopping Places Icon',
				'desc' => '',
				'id' => $prefix . 'shopping_place_icon',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Shopping Places Link Text',
				'desc' => '',
				'id' => $prefix . 'shopping_place_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Shopping Places Link',
				'desc' => '',
				'id' => $prefix . 'shopping_place_link',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Attraction Places Heading H4',
				'desc' => '',
				'id' => $prefix . 'attraction_place_heading_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Attraction Places Heading H5',
				'desc' => '',
				'id' => $prefix . 'attraction_place_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Attraction Places Icon',
				'desc' => '',
				'id' => $prefix . 'attraction_place_icon',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Attraction Places Link Text',
				'desc' => '',
				'id' => $prefix . 'attraction_place_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Attraction Places Link',
				'desc' => '',
				'id' => $prefix . 'attraction_place_link',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eatery Places Heading H4',
				'desc' => '',
				'id' => $prefix . 'eatery_place_heading_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eatery Places Heading H5',
				'desc' => '',
				'id' => $prefix . 'eatery_place_heading_h5',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eatery Places Icon',
				'desc' => '',
				'id' => $prefix . 'eatery_place_icon',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Eatery Places Link Text',
				'desc' => '',
				'id' => $prefix . 'eatery_place_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Eatery Places Link',
				'desc' => '',
				'id' => $prefix . 'eatery_place_link',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	new RW_Meta_Box( $meta_box_2 );
}

// Add a new column for the order
function add_new_ptype_whatsnearby_column($ptype_whatsnearby_columns) {
  $ptype_whatsnearby_columns['menu_order'] = "Order";
  return $ptype_whatsnearby_columns;
}
add_action('manage_edit-ptype_whatsnearby_columns', 'add_new_ptype_whatsnearby_column');

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
// add_action('manage_ptype_whatsnearby_posts_custom_column','show_order_column_events');

// // Set the column to be sortable
// function order_column_register_sortable_events($columns){
//   $columns['menu_order'] = 'menu_order';
//   return $columns;
// }
// add_filter('manage_edit-ptype_whatsnearby_sortable_columns','order_column_register_sortable_events');
?>