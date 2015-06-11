<?php
// ptype_contacts Custom Post Type
add_action( 'init', 'ptype_contacts_post_type' );
function ptype_contacts_post_type() {
	register_post_type( 'ptype_contacts',
		array(
			'labels' => array(
				'name' => __( 'Contact Sections', 'theme' ),
				'singular_name' => __( 'Contact Section', 'theme' ),
				'add_new' =>  __( 'Add New Contact Section', 'theme' ),
				'add_new_item' =>  __( 'Add New Contact Section', 'theme' ),
				'edit_item' =>  __( 'Edit Contact Section', 'theme' ),
				'new_item' =>  __( 'New Contact Section', 'theme' ),
				'all_items' =>  __( 'All Contact Sections', 'theme' ),
				'view_item' =>  __( 'View Contact Section', 'theme' ),
				'search_items' =>  __( 'Search Contact Section', 'theme' ),
				'not_found' =>   __( 'No Contact Section found', 'theme' ),
				'not_found_in_trash' =>  __( 'No Contact Section found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'Contact Sections', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 100,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'event', 'with_front' => true ),
		'menu_icon' => 'dashicons-businessman',  // Icon Path
		)
	);
}

// MetaBox
add_action( 'admin_init', 'ptype_contacts_register_meta_box' );
function ptype_contacts_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_contacts_';
    $meta_box = array(
			'id' => 'contact',
			'title' => 'Contact Heading',
			'pages' => array( 'ptype_contacts' ),
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
					)

				)
			);
    new RW_Meta_Box( $meta_box );

    $meta_box_2 = array(
			'id' => 'contact-info',
			'title' => 'Contact Info',
			'pages' => array( 'ptype_contacts' ),
			'context' => 'normal',
			'priority' => 'core',
			'fields' => array(
					
					array(
						'name' => 'Contact Heading 1 h5',
						'desc' => '',
						'id' => $prefix . 'heading_1_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 1 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_1_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Contact Heading 2 h5',
						'desc' => '',
						'id' => $prefix . 'heading_2_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 2 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_2_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Contact Heading 3 h5',
						'desc' => '',
						'id' => $prefix . 'heading_3_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 3 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_3_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Contact Heading 4 h5',
						'desc' => '',
						'id' => $prefix . 'heading_4_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 4 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_4_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Contact Heading 5 h5',
						'desc' => '',
						'id' => $prefix . 'heading_5_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 5 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_5_paragraph_html',
						'type' => 'textarea'
					),

					array(
						'name' => 'Contact Heading 6 h5',
						'desc' => '',
						'id' => $prefix . 'heading_6_h5',
						'type' => 'text',
						'std' => ''
					),

					array(
						'name' => 'Contact Heading 6 Paragraph HTML',
						'desc' => '',
						'id' => $prefix . 'heading_6_paragraph_html',
						'type' => 'textarea'
					)
				)
			);

	new RW_Meta_Box( $meta_box_2 );
}

// Add a new column for the order
function add_new_ptype_contacts_column($ptype_contacts_columns) {
  $ptype_contacts_columns['menu_order'] = "Order";
  return $ptype_contacts_columns;
}
add_action('manage_edit-ptype_contacts_columns', 'add_new_ptype_contacts_column');

// Render the column values
function show_contact_order_column_events($name){
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
add_action('manage_ptype_contacts_posts_custom_column','show_contact_order_column_events');

// Set the column to be sortable
function contact_order_column_register_sortable_events($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-ptype_contacts_sortable_columns','contact_order_column_register_sortable_events');
?>