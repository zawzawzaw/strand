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

/*-----------------------------------------------------------------------------------*/
/* What's Nearby
/*-----------------------------------------------------------------------------------*/
add_shortcode('whatsnearby', 'theme_shortcode_whatsnearby');   
function theme_shortcode_whatsnearby($attr, $content)
{        
    ob_start();
    get_template_part('/includes/whatsnearby');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* Places
/*-----------------------------------------------------------------------------------*/
add_shortcode('places', 'theme_shortcode_places');   
function theme_shortcode_places($attr, $content)
{        
    ob_start();
    get_template_part('/includes/places');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* Amenities
/*-----------------------------------------------------------------------------------*/
add_shortcode('amenities', 'theme_shortcode_amenities');   
function theme_shortcode_amenities($attr, $content)
{        
    ob_start();
    get_template_part('/includes/amenities');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* Contact
/*-----------------------------------------------------------------------------------*/
add_shortcode('contact', 'theme_shortcode_contact');   
function theme_shortcode_contact($attr, $content)
{        
    ob_start();
    get_template_part('/includes/contact');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* FAQs
/*-----------------------------------------------------------------------------------*/
add_shortcode('faqs', 'theme_shortcode_faqs');   
function theme_shortcode_faqs($attr, $content)
{        
    ob_start();
    get_template_part('/includes/faqs');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}


/*-----------------------------------------------------------------------------------*/
/* FAQ
/*-----------------------------------------------------------------------------------*/
add_shortcode('faq', 'theme_shortcode_faq');   
function theme_shortcode_faq($attr, $content)
{        
    ob_start();
    get_template_part('/includes/faq');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}