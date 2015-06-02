<?php
// MetaBox
add_action( 'admin_init', 'page_register_meta_box' );
function page_register_meta_box()
{
    // Check if plugin is activated or included in theme
    if ( !class_exists( 'RW_Meta_Box' ) )
    return;
    $prefix = 'page_';
    $meta_box = array(
			'id' => 'section-settings',
			'title' => 'Page Settings',
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
					array(
						'name' => 'Page Headline H5',
						'desc' => '',
						'id' => $prefix . 'tagline_H5',
						'type' => 'text'
					),
					array(
						'name' => 'Page SubHeadline H1',
						'desc' => '',
						'id' => $prefix . 'tagline_H1',
						'type' => 'text'
					),								
					
					array(
						'name' => 'Header Image',
						'desc' => '',
						'id' => $prefix . 'header_image',
						'type' => 'image_advanced',
						'max_file_uploads' => 1
					),
										
					array(
						'name' => 'Header Caption Text',
						'desc' => '',
						'id' => $prefix . 'header_caption',
						'type' => 'textarea'
					)
						
				 )
			);
    new RW_Meta_Box( $meta_box );
}
?>