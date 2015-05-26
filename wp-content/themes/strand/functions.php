<?php 
/********************************************************************************************************/
/* CONSTANTS */
/********************************************************************************************************/

define("THEMEROOT", get_stylesheet_directory_uri());
define("IMAGES", THEMEROOT."/img");
define("JS", THEMEROOT."/js");


/********************************************************************************************************/
/* MENUS */
/********************************************************************************************************/

// function register_my_menus(){
// 	register_nav_menus(array(
// 		'main-menu' => __('Main Menu', 'ykvn')
// 	));
// }

// add_action('init', 'register_my_menus');

// ## adding class name to submenu parent li
// function menu_set_dropdown( $sorted_menu_items, $args ) {
//     $last_top = 0;
//     foreach ( $sorted_menu_items as $key => $obj ) {
//         // it is a top lv item?
//         if ( 0 == $obj->menu_item_parent ) {
//             // set the key of the parent
//             $last_top = $key;
//         } else {
//             $sorted_menu_items[$last_top]->classes['dropdown'] = 'subnav';
//         }
//     }
//     return $sorted_menu_items;
// }
// add_filter( 'wp_nav_menu_objects', 'menu_set_dropdown', 10, 2 );

/********************************************************************************************************/
/* LOAD JS */
/********************************************************************************************************/

add_action('wp_enqueue_scripts', 'load_scripts');

function load_scripts(){
    wp_enqueue_script('initSlider', THEMEROOT.'/js/init.js', array('jquery'), true);
}


/********************************************************************************************************/
/* ADD POST THUMBNAIL SUPPORT */
/********************************************************************************************************/

if(function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(940, 346);
}

/********************************************************************************************************/
/* ADD WIDGETS */
/********************************************************************************************************/

// function arphabet_widgets_init() {

//     register_sidebar( array(
//         'name' => 'Home right sidebar',
//         'id' => 'home_right_1',
//         'before_widget' => '<div>',
//         'after_widget' => '</div>',
//         'before_title' => '<h2 class="rounded">',
//         'after_title' => '</h2>',
//     ) );
// }
// add_action( 'widgets_init', 'arphabet_widgets_init' );


/********************************************************************************************************/
/* CUSTOM POST TYPE & META BOXES */
/********************************************************************************************************/

// require 'my-custom-posts.php';

// # lawyers post #

// add_post_type('lawyers', array(
//     'supports' => array('title','aside','thumbnail'),
//     'capabilities' => array('manage_terms' => 'manage_categories', 'edit_terms' => 'manage_categories', 'delete_terms' => 'manage_categories', 'assign_terms' => 'edit_posts')
// ));

// add_taxonomy('practices', 'lawyers', array(
//     'labels' => array('add_new_item' => 'Add New Practice'),
//     'capabilities' => array('manage_terms' => 'manage_categories', 'edit_terms' => 'manage_categories', 'delete_terms' => 'manage_categories', 'assign_terms' => 'edit_posts')
// ));

// add_taxonomy('membership', 'lawyers', array(
//     'labels' => array('add_new_item' => 'Add New Membership')
// ));

// add_taxonomy('type', 'lawyers', array(
//     'labels' => array('add_new_item' => 'Add New Type')
// ));

// add_my_meta_box('Lawyer Details', 'lawyers'); #title , post_type

// # end lawyers #

// # slider post #

// add_post_type('slider', array(
//     'supports' => array('title','aside','thumbnail')
// ));

// add_taxonomy('place', 'slider', array(
//     'labels' => array('add_new_item' => 'Add New Page')
// ));

// # end slider #

// # testimonial post #

// add_post_type('testimonial', array(
//     'supports' => array('title','editor','aside')
// ));

// # end testimonial #

// # home page columns post #

// add_post_type('home page columns', array(
//     'supports' => array('title','editor','aside')
// ));

// # end  home page columns #

// # news page columns post #

// add_post_type('news', array(
//     'supports' => array('title','editor','aside')
// ));

// # end news page columns #


// /********************************************************************************************************/
// /* WORDPRESS EDITOR CUSTOM FIELDS */
// /********************************************************************************************************/

// function Custom_get_featured_image($post_ID) {  
//     $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
//     if ($post_thumbnail_id) {  
//         $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
//         return $post_thumbnail_img[0];  
//     }  
// }  

// function Custom_get_meta_post($post_ID) {  
//     $custom_fields = get_post_meta($post_ID);

//     if(!empty($custom_fields)) {
//         return $custom_fields;
//     }
// }  

// function Custom_get_meta_post_terms($post_ID, $type) {  
//     $custom_posts_terms = wp_get_post_terms($post_ID, $type);

//     if(!empty($custom_posts_terms)) {
//         return $custom_posts_terms;
//     }
// }  

// function Lawyers_columns_head($defaults) {  
//     $new_columns['title'] = _x('Lawyers Name', 'column name');
//     $new_columns['featured_image'] = 'Featured Image';  
//     $new_columns['practices'] = 'Practices';  
//     $new_columns['membership'] = 'Membership';  
//     $new_columns['type'] = 'Type';  
//     $new_columns['lawyer_order'] = 'Lawyer\'s Order';  
//     $new_columns['date'] = _x('Date', 'column name');

//     return $new_columns;  
// }  

// function Lawyers_columns_content($column_name, $post_ID) {  
//     if ($column_name == 'featured_image') {  
//         $post_featured_image = Custom_get_featured_image($post_ID);  
//         if ($post_featured_image) {  
//             // HAS A FEATURED IMAGE  
//             echo '<img src="' . $post_featured_image . '" height="124" width="100" >';  
//         }  
//         else {  
//             // NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
//             echo '<img src="' . get_bloginfo( 'template_url' ) . '/images/default.jpg" />';  
//         }  
//     }

//     if($column_name == 'lawyer_order') {
//         $custom_post_meta = Custom_get_meta_post($post_ID,$column_name);

//         echo $custom_post_meta['lawyer_order'][0];
//     }

//     $all_terms = array('practices', 'membership', 'type', 'lawyer_order');

//     foreach ($all_terms as $key => $term) {
//         if($column_name==$term) {
//             $custom_post_meta = Custom_get_meta_post_terms($post_ID,$term);

//             if ($custom_post_meta) {  
//                 foreach ($custom_post_meta as $key => $meta) {
//                     echo $meta->name . '<br>';
//                 }
//             }  
//             else {  
//                 echo '';  
//             }
//         }
//     }
// }   

// function Slider_colums_head($defaults) {
//     $new_columns['title'] = _x('Slider Name', 'column name');
//     $new_columns['featured_image'] = 'Featured Image';  
//     $new_columns['place'] = 'Place';  
//     $new_columns['date'] = _x('Date', 'column name');

//     return $new_columns;  
// }

// function Slider_columns_content($column_name, $post_ID) {  
//     if ($column_name == 'featured_image') {  
//         $post_featured_image = Custom_get_featured_image($post_ID);  
//         if ($post_featured_image) {  
//             // HAS A FEATURED IMAGE  
//             echo '<img src="' . $post_featured_image . '" height="37" width="100" >';  
//         }  
//         else {  
//             // NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
//             echo '<img src="' . get_bloginfo( 'template_url' ) . '/images/default.jpg" />';  
//         }  
//     }

//     $all_terms = array('place');

//     foreach ($all_terms as $key => $term) {
//         if($column_name==$term) {
//             $custom_post_meta = Custom_get_meta_post_terms($post_ID,$term); 

//             if ($custom_post_meta) {  
//                 foreach ($custom_post_meta as $key => $meta) {
//                     echo $meta->name . '<br>';
//                 }
//             }  
//             else {  
//                 echo '';  
//             }
//         }
//     }
// }   

// function Testimonial_colums_head($defaults) {
//     $new_columns['title'] = _x('Testimonial and Awards', 'column name');
//     $new_columns['date'] = _x('Date', 'column name');

//     return $new_columns;  
// }

// add_filter('manage_lawyers_posts_columns', 'Lawyers_columns_head');  
// add_action('manage_lawyers_posts_custom_column', 'Lawyers_columns_content', 10, 2);

// add_filter('manage_slider_posts_columns', 'Slider_colums_head');  
// add_action('manage_slider_posts_custom_column', 'Slider_columns_content', 10, 2);

// add_filter('manage_testimonial_posts_columns', 'Testimonial_colums_head');  

/********************************************************************************************************/
/* WORDPRESS EDITOR FIX */
/********************************************************************************************************/

function change_mce_options( $init ) {  
     //code that adds additional attributes to the pre tag  
     $ext = 'article[id|name|class|style|x|y|cx|cy|nav]';  
      
     //if extended_valid_elements alreay exists, add to it  
     //otherwise, set the extended_valid_elements to $ext  
     if ( isset( $init['extended_valid_elements'] ) ) {  
      $init['extended_valid_elements'] .= ',' . $ext;  
     } else {  
      $init['extended_valid_elements'] = $ext;  
     }  
      
     //important: return $init!  
     return $init;  
} 

function change_mce_options_2( $init ) {  
     //code that adds additional attributes to the pre tag  
     $ext = 'div[id|name|class|style|x|y|cx|cy|nav]';  
      
     //if extended_valid_elements alreay exists, add to it  
     //otherwise, set the extended_valid_elements to $ext  
     if ( isset( $init['extended_valid_elements'] ) ) {  
      $init['extended_valid_elements'] .= ',' . $ext;  
     } else {  
      $init['extended_valid_elements'] = $ext;  
     }  
      
     //important: return $init!  
     return $init;  
} 

add_filter('tiny_mce_before_init', 'change_mce_options');  
add_filter('tiny_mce_before_init', 'change_mce_options_2'); 

// add excerpt support
add_action('init', 'my_custom_init');
function my_custom_init() {
    add_post_type_support( 'page', 'excerpt' );
}


?>