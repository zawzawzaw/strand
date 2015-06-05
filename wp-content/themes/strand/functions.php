<?php 
/********************************************************************************************************/
/* CONSTANTS */
/********************************************************************************************************/

define("THEMEROOT", get_stylesheet_directory_uri());
define("IMG", THEMEROOT."/images");
define("JS", THEMEROOT."/js");
define("CSS", THEMEROOT."/css");


/********************************************************************************************************/
/* MENUS */
/********************************************************************************************************/

function register_my_menus(){
	register_nav_menus(array(
		'main-menu' => __('Main Menu', 'strand'),
    'footer-menu' => __('Footer Menu', 'strand')
	));
}

add_action('init', 'register_my_menus');

/********************************************************************************************************/
/* LOAD ASSETS */
/********************************************************************************************************/

add_action('wp_enqueue_scripts', 'load_scripts');

function load_scripts(){
    wp_enqueue_style( 'bootstrap', THEMEROOT.'/css/vendors/bootstrap/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-theme', THEMEROOT.'/css/vendors/bootstrap/bootstrap-theme.min.css' );
    wp_enqueue_style( 'jquery-ui', THEMEROOT.'/css/vendors/jquery-ui/jquery-ui.min.css' );
    wp_enqueue_style( 'font-awesome', THEMEROOT.'/css/font-awesome.min.css' );
    wp_enqueue_style( 'stylecss', get_stylesheet_uri() );

    wp_enqueue_script('$', THEMEROOT.'/js/vendors/jquery/jquery-1.11.1.min.js', array(), '', true);
    wp_enqueue_script('jquery-ui', THEMEROOT.'/js/vendors/jquery/jquery-ui.min.js', array('$'), '', true);
    wp_enqueue_script('carousel', THEMEROOT.'/js/vendors/bootstrap/bootstrap.min.js', array('$'), '', true);
    wp_enqueue_script('imagesloaded', THEMEROOT.'/js/plugins/imagesloaded.pkgd.min.js', array('$'), '', true);
    wp_enqueue_script('masonry', THEMEROOT.'/js/plugins/masonry.pkgd.min.js', array('$'), '', true);    
    wp_enqueue_script('mainjs', THEMEROOT.'/js/main.js', array('$'), '', true);

    if(is_home()) {
        wp_enqueue_script('homejs', THEMEROOT.'/js/home.js', array('$'), '', true);
    } 
    if(is_page('rooms')) {
        wp_enqueue_script('roomsjs', THEMEROOT.'/js/rooms.js', array('$'), '', true);
    }
    if(is_page('deluxe-room')) {
        wp_enqueue_script('deluxeroomjs', THEMEROOT.'/js/deluxe-room.js', array('$'), '', true);
    }
    if(is_page('about')) {
        wp_enqueue_script('aboutjs', THEMEROOT.'/js/about.js', array('$'), '', true);
    }
    if(is_page('whats-nearby')) {        
        wp_enqueue_script('googlemap', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places', array(), '', true);
        wp_enqueue_script('infobox', THEMEROOT.'/js/plugins/infobox.js', array('$'), '', true);
        wp_enqueue_script('whatsnearby', THEMEROOT.'/js/whatsnearby.js', array('$'), '', true);
    }
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

require 'my-custom-posts.php';

# home slider post #

add_post_type('home slider', array(
    'supports' => array('title','editor','aside','thumbnail')
));

# room slider post #

add_post_type('room slider', array(
    'supports' => array('title','editor','aside','thumbnail')
));

# room type slider post #

add_post_type('each room slider', array(
    'supports' => array('title','editor','aside','thumbnail')
));

add_taxonomy('type', 'eachroomslider', array(
    'labels' => array('add_new_item' => 'Add New Page','name'=>'Room Type')
));

# feature post #

add_post_type('feature', array(
    'supports' => array('title','editor','aside')
));

add_taxonomy('feature_room_type', 'feature', array(
    'labels' => array('add_new_item' => 'Add New Page','name'=>'Room Type')
));

// /********************************************************************************************************/
// /* WORDPRESS EDITOR CUSTOM FIELDS */
// /********************************************************************************************************/

function Custom_get_featured_image($post_ID) {  
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);  
    if ($post_thumbnail_id) {  
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');  
        return $post_thumbnail_img[0];  
    }  
}  

function Custom_get_meta_post($post_ID) {  
    $custom_fields = get_post_meta($post_ID);

    if(!empty($custom_fields)) {
        return $custom_fields;
    }
}

function Custom_get_meta_post_terms($post_ID, $type) {  
    $custom_posts_terms = wp_get_post_terms($post_ID, $type);

    if(!empty($custom_posts_terms)) {
        return $custom_posts_terms;
    }
}

function Slider_colums_head($defaults) {
    $new_columns['title'] = _x('Slider Name', 'column name');
    $new_columns['featured_image'] = 'Featured Image';  
    $new_columns['place'] = 'Place';  
    $new_columns['date'] = _x('Date', 'column name');

    return $new_columns;  
}

function Slider_columns_content($column_name, $post_ID) {  
    if ($column_name == 'featured_image') {  
        $post_featured_image = Custom_get_featured_image($post_ID);  
        if ($post_featured_image) {  
            // HAS A FEATURED IMAGE  
            echo '<img src="' . $post_featured_image . '" height="37" width="100" >';  
        }  
        else {  
            // NO FEATURED IMAGE, SHOW THE DEFAULT ONE  
            echo '<img src="' . get_bloginfo( 'template_url' ) . '/images/default.jpg" />';  
        }  
    }

    $all_terms = array('place');

    foreach ($all_terms as $key => $term) {
        if($column_name==$term) {
            $custom_post_meta = Custom_get_meta_post_terms($post_ID,$term); 

            if ($custom_post_meta) {  
                foreach ($custom_post_meta as $key => $meta) {
                    echo $meta->name . '<br>';
                }
            }  
            else {  
                echo '';  
            }
        }
    }
}

add_filter('manage_slider_posts_columns', 'Slider_colums_head');  
add_action('manage_slider_posts_custom_column', 'Slider_columns_content', 10, 2);

// Include MetaBoxes plugin
include (TEMPLATEPATH . "/lib/meta-box/meta-box.php");

// Include in all pages except home
include (TEMPLATEPATH . "/lib/metabox-page.php");

// Include new post types and metabox for home and other pages
include (TEMPLATEPATH . "/lib/ptype-sections.php");
include (TEMPLATEPATH . "/lib/ptype-rooms.php");
include (TEMPLATEPATH . "/lib/ptype-events.php");
include (TEMPLATEPATH . "/lib/ptype-roomtypes.php");
include (TEMPLATEPATH . "/lib/ptype-about.php");
include (TEMPLATEPATH . "/lib/ptype-whatsnearby.php");
include (TEMPLATEPATH . "/lib/ptype-places.php");

// Include Shortcodes
include (TEMPLATEPATH . "/lib/shortcodes.php");

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

// hide admin bar from front end
function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );
?>