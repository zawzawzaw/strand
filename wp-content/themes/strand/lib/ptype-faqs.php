<?php
// ptype_faqs Custom Post Type
add_action( 'init', 'ptype_faqs_post_type' );
function ptype_faqs_post_type() {
	register_post_type( 'ptype_faqs',
		array(
			'labels' => array(
				'name' => __( 'FAQs', 'theme' ),
				'singular_name' => __( 'FAQs', 'theme' ),
				'add_new' =>  __( 'Add New FAQ', 'theme' ),
				'add_new_item' =>  __( 'Add New FAQ', 'theme' ),
				'edit_item' =>  __( 'Edit FAQ', 'theme' ),
				'new_item' =>  __( 'New FAQ', 'theme' ),
				'all_items' =>  __( 'All FAQs', 'theme' ),
				'view_item' =>  __( 'View FAQ', 'theme' ),
				'search_items' =>  __( 'Search FAQ', 'theme' ),
				'not_found' =>   __( 'No FAQ found', 'theme' ),
				'not_found_in_trash' =>  __( 'No FAQ found in Trash', 'theme' ), 
				'parent_item_colon' => '',
				'menu_name' =>  __( 'FAQs', 'theme' )
			),
		'public' => true,
		'has_archive' => true,
		'hierarchical' => false,	
		'menu_position' => 100,
		'supports' => array( 'title', 'page-attributes', 'thumbnail' ), 
		'rewrite'  => array( 'slug' => 'nearby_places', 'with_front' => true ),
		'menu_icon' => 'dashicons-lightbulb',  // Icon Path
		)
	);
}

add_taxonomy('questiontype', 'ptype_faqs', array(
    'labels' => array('add_new_item' => 'Add New Page','name'=>'Question Type')
));

// MetaBox
add_action( 'admin_init', 'ptype_faqs_register_meta_box' );
function ptype_faqs_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'ptype_faqs_';
    $meta_box = array(
			'id' => 'faqs',
			'title' => 'FAQs',
			'pages' => array( 'ptype_faqs' ),
			'context' => 'normal',
			'priority' => 'core',
			'fields' => array(														
					
					array(
						'name' => 'Question',
						'desc' => '',
						'id' => $prefix . 'question',
						'type' => 'text',
					),

					array(
						'name' => 'Answer',
						'desc' => '',
						'id' => $prefix . 'answer',
						'type' => 'textarea'
					),					
					
				)
			);
    new RW_Meta_Box( $meta_box );

}

// Add a new column for the order
function add_new_ptype_faqs_column($ptype_faqs_columns) {
  $ptype_faqs_columns['menu_order'] = "Order";
  return $ptype_faqs_columns;
}
add_action('manage_edit-ptype_faqs_columns', 'add_new_ptype_faqs_column');

// Render the column values
function show_faqs_order_column_events($name){
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
add_action('manage_ptype_faqs_posts_custom_column','show_faqs_order_column_events');

// Set the column to be sortable
function faqs_order_column_register_sortable_events($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-ptype_faqs_sortable_columns','faqs_order_column_register_sortable_events');
?>