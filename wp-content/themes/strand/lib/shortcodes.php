<?php
/*-----------------------------------------------------------------------------------*/
/* Enable shortdoces in sidebar default Text widget
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/* Rooms
/*-----------------------------------------------------------------------------------*/
add_shortcode('rooms', 'theme_shortcode_rooms');   
function theme_shortcode_rooms($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/rooms');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* Rooms Details
/*-----------------------------------------------------------------------------------*/
add_shortcode('roomtypes', 'theme_shortcode_roomtypes');   
function theme_shortcode_roomtypes($attr, $content)
{        
    ob_start();
    get_template_part('/includes/roomtypes');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* About
/*-----------------------------------------------------------------------------------*/
add_shortcode('about', 'theme_shortcode_about');   
function theme_shortcode_about($attr, $content)
{        
    ob_start();
    get_template_part('/includes/about');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}