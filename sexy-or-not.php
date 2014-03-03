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
include_once(plugin_dir_path(__FILE__).'/config.php');

add_action('admin_menu', 'sexy_menu');

function sexy_menu() {
    add_menu_page(__('Sexy or Not','Sexy or Not'), __('Sexy or Not','statics'), 'manage_options', 'sexy-options', 'options' );
    add_submenu_page("sexy-options", "Configuration", "Configuration", 0, "sexy-configuration", "configuration");
}

function options(){
    if( !current_user_can('manage_options') ){
        wp_die(__('You do not have sufficient permission to access this page'));
    }
?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br /></div><h2>Sexy or Not</h2>

        <h2>Statics</h2>
        <h3>Top rated</h3>
        </form>
    </div>
<?php
}// Options

function configuration(){
}
