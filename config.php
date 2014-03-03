<?php
/**
 * Configuration file, this file set the default files to use 
 * in the site, files like: *.js, *.ccc and so on.
 */
// Add the script.js file to the stack of loading files
add_action("wp_enqueue_scripts", "sexy_scripts");
function sexy_scripts(){
    wp_enqueue_script("jquery");
    wp_register_script("sexy-script", plugins_url("/js/script.js", __FILE__), array(), null);
    wp_enqueue_script("sexy-script");
}

// Add the file style.css as the base styles
function sexy_styles(){
    wp_register_style("sexy-style", plugins_url("/css/style.css", __FILE__), array(), null, "all");
    wp_enqueue_style("sexy-style");
}
add_action("wp_enqueue_scripts", "sexy_styles");

// [sexy size="large"]
/*
 * Set the shortcode, the usage is the following
 * without any parameter the image to show is the meidum size, the
 * available sizes are:
 *
 * - thumnail
 * - medim
 * - large
 * - full
 */
function sexy_short_code_function( $atts ) {
    extract( shortcode_atts( array('size' => 'medium',), $atts ) );
    
    $sexy = new Sexy($size); 
    $votes = new Vote();
    $votes->set_message("Choose a ranking to see the next picture.");
    $votes->generate_html();
    return $sexy->get_image();
}
add_shortcode( 'sexy', 'sexy_short_code_function' );
