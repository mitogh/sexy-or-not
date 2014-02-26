<?php
/**
 * Plugin Name: Sexy or Not
 * Plugin URI: https://github.com/mitogh/sexy-or-not/
 * Description: Use the system to rate and image from your library
 * Version: 0.1
 * Author: Crisoforo.
 * Author URI: http://www.crisoforo.com
 * License: GPL2
 */

include_once(plugin_dir_path(__FILE__).'/class-sexy.php');
include_once(plugin_dir_path(__FILE__).'/class-vote.php');

add_action('admin_menu', 'sexy_menu');

function sexy_menu() {
    add_menu_page(__('Sexy Options','Sexy or Not'), __('Sexy Options','menu-test'), 'manage_options', 'sexy-options', 'options' );
}

function options(){

    if( !current_user_can('manage_options') ){
        wp_die(__('You do not have sufficient permission to access this page'));
    }
?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br /></div><h2>Sexy Options</h2>

            <h2>Statics</h2>
            <?php
            ?>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>

        </form>
    </div>
<?php
}// Options

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
function sexy_short_code_function( $atts ) {
    extract( shortcode_atts( array('size' => 'medium',), $atts ) );
    
    $sexy = new Sexy($size); 
    $votes = new Vote();
    $votes->set_message("Choose a ranking to see the next picture.");
    $votes->generate_html();
    return $sexy->get_image();
}
add_shortcode( 'sexy', 'sexy_short_code_function' );
