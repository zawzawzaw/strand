<?php
// ptype_sections Custom Post Type
add_action( 'init', 'ptype_sections_post_type' );
function ptype_sections_post_type() {
	register_post_type( 'ptype_sections',
		array(
			'labels' => array(
				'name' => __( 'Sections', 'theme' ),
				'singular_name' => __( 'Section', 'theme' ),
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
				'menu_name' =>  __( 'Home Sections', 'theme' )
			),
			'public' => true,
			'has_archive' => true,
			'hierarchical' => false,	
			'menu_position' => 5,
			'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
			'rewrite'  => array( 'slug' => 'ptype_sections', 'with_front' => true ),
			'menu_icon' => 'dashicons-format-aside',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_sections_register_meta_box' );
function ptype_sections_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 	'ptype_sections_';
    $meta_box = array(
		'id' => 'sections-settings',
		'title' => 'Discover Us Section',
		'pages' => array( 'ptype_sections' ),
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
				'name' => 'List Item Heading H3 ',
				'desc' => '',
				'id' => $prefix . 'list_item_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'List Item Paragraph P ',
				'desc' => '',
				'id' => $prefix . 'list_item_paragraph_p',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'List Item 2 Heading H3 ',
				'desc' => '',
				'id' => $prefix . 'list_item_2_heading_h3',
				'type' => 'text',
				'std' => ''
			),		

			array(
				'name' => 'List Item 2 Paragraph P ',
				'desc' => '',
				'id' => $prefix . 'list_item_2_paragraph_p',
				'type' => 'text',
				'std' => ''
			),	

			array(
				'name' => 'List Item 3 Heading H3 ',
				'desc' => '',
				'id' => $prefix . 'list_item_3_heading_h3',
				'type' => 'text',
				'std' => ''
			),		

			array(
				'name' => 'List Item 3 Paragraph P ',
				'desc' => '',
				'id' => $prefix . 'list_item_3_paragraph_p',
				'type' => 'text',
				'std' => ''
			),									
			
			array(
				'name' => 'Discover Us Images',
				'desc' => '',
				'id' => $prefix . 'discover_us_img_1',
				'type' => 'image_advanced'
			)
	 	)
	);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
    	'id' => 'sections-settings-2',
		'title' => 'What\'s Nearby Section',
		'pages' => array( 'ptype_sections' ),
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
				'name' => 'What\'s Nearby Heading H2',
				'desc' => '',
				'id' => $prefix . 'whats_nearby_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'What\'s Nearby Heading H3 ',
				'desc' => '',
				'id' => $prefix . 'whats_nearby_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'What\'s Nearby Images',
				'desc' => '',
				'id' => $prefix . 'whats_nearby_img',
				'type' => 'image_advanced'
			),

			array(
				'name' => 'What\'s Nearby Images HTML',
				'desc' => '',
				'id' => $prefix . 'whats_nearby_img_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'What\'s Nearby Images HTML 2',
				'desc' => '',
				'id' => $prefix . 'whats_nearby_img_html_2',
				'type' => 'textarea'
			),

			array(
				'name' => 'Event Heading H4',
				'desc' => '',
				'id' => $prefix . 'event_heading_h4',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Event Heading H3',
				'desc' => '',
				'id' => $prefix . 'event_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Link Text',
				'desc' => '',
				'id' => $prefix . 'link_text',
				'type' => 'text',
				'std' => ''
			),
			
			array(
				'name' => 'Link',
				'desc' => '',
				'id' => $prefix . 'link',
				'type' => 'text',
				'std' => ''
			),
		)
    );
    new RW_Meta_Box( $meta_box_2 );

    $meta_box_3 = array(
    	'id' => 'sections-settings-3',
		'title' => 'Featured Offers Section',
		'pages' => array( 'ptype_sections' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(			

			array(
				'name' => 'Featured Offers Heading H2',
				'desc' => '',
				'id' => $prefix . 'featured_offers_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Featured Offers Heading H3 ',
				'desc' => '',
				'id' => $prefix . 'featured_offers_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Deal 1 Image',
				'desc' => '',
				'id' => $prefix . 'deal_1_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Deal 1 Image HTML',
				'desc' => '',
				'id' => $prefix . 'deal_1_img_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Deal 2 Image',
				'desc' => '',
				'id' => $prefix . 'deal_2_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Deal 2 Image HTML',
				'desc' => '',
				'id' => $prefix . 'deal_2_img_html',
				'type' => 'textarea'
			),

			array(
				'name' => 'Deal 3 Image',
				'desc' => '',
				'id' => $prefix . 'deal_3_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Deal 3 Image HTML',
				'desc' => '',
				'id' => $prefix . 'deal_3_img_html',
				'type' => 'textarea'
			),
		)
	);

	new RW_Meta_Box( $meta_box_3 );

	$meta_box_4 = array(
    	'id' => 'sections-settings-4',
		'title' => 'Classic Hotel Section',
		'pages' => array( 'ptype_sections' ),
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(	

			array(
				'name' => 'Classic Hotel Background',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_bg',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),

			array(
				'name' => 'Classic Hotel Heading H2',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_heading_h2',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Classic Hotel Heading H3',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_heading_h3',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Classic Hotel Paragraph P',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_paragraph_p',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Classic Hotel Link Text',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_link_text',
				'type' => 'text',
				'std' => ''
			),

			array(
				'name' => 'Classic Hotel Link',
				'desc' => '',
				'id' => $prefix . 'classic_hotel_link',
				'type' => 'text',
				'std' => ''
			)	
		)
	);

	new RW_Meta_Box( $meta_box_4 );
}

// Add a new column for the order
function add_new_ptype_sections_column($ptype_sections_columns) {
  $ptype_sections_columns['menu_order'] = "Order";
  return $ptype_sections_columns;
}
add_action('manage_edit-ptype_sections_columns', 'add_new_ptype_sections_column');

// Render the column values
function show_order_column_sections($name){
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
add_action('manage_ptype_sections_posts_custom_column','show_order_column_sections');

// Set the column to be sortable
function order_column_register_sortable_sections($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-ptype_sections_sortable_columns','order_column_register_sortable_sections');

function disable_new_posts() {
// Hide sidebar link
global $submenu;
unset($submenu['edit.php?post_type=ptype_sections'][10]);

// Hide link on listing page
if (isset($_GET['post_type']) && $_GET['post_type'] == 'ptype_sections') {
    echo '<style type="text/css">
    #favorite-actions, .add-new-h2, .tablenav { display:none; }
    </style>';
}
}
add_action('admin_menu', 'disable_new_posts');
?>