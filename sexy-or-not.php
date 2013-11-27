<?php
/**
 * Plugin Name: Sexy or Not
 * Plugin URI: http://www.crisoforo.com
 * Description: Use the system to rate and image from your library
 * Version: 1.0
 * Author: Crisoforo.
 * Author URI: http://www.crisoforo.com
 * License: GPL2
 */


include_once(plugin_dir_path(__FILE__).'/Sexy.class.php');

add_action('admin_menu', 'sexy_menu');

function sexy_menu() {
    add_menu_page(__('Sexy Options','Sexy or Not'), __('Sexy Options','menu-test'), 'manage_options', 'mt-top-level-handle', 'options' );
}


function options(){

    if( !current_user_can('manage_options') ){
        wp_die(__('You do not have sufficient permission to access this page'));
    }
?>
    <div class="wrap">
        <div id="icon-options-general" class="icon32"><br /></div><h2>Sexy Options</h2>

        <form method="post" action="options.php">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="minimum_rating">Minimum Rating</label></th>
                    <td>
                        <input name="minimum_rating" type="text" id="minimum_rating" value="1" class="regular-text" />
                        <p class="description">The minimum rating for each image.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="maximum_rating">Maximum Rating</label></th>
                    <td><input name="maximum_rating" type="text" id="maximum_rating" value="10" class="regular-text" />
                    <p class="description">The maximum rating for each image.</p></td>
                </tr>
            </table>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>

        </form>
    </div>
<?php
}// Options