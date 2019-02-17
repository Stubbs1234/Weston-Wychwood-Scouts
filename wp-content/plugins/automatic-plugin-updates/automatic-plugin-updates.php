<?php
/*
Plugin Name: Automatic Plugin Updates
Plugin URI: https://www.whitefirdesign.com/automatic-plugin-updates
Description: Enables automatic background updates of plugins. Supports excluding selected plugins from being automatically updated.
Version: 1.0.2
Author: White Fir Design
Author URI: https://www.whitefirdesign.com/
License: GPLv2
Text Domain: automatic-plugin-updates
Domain Path: /languages

Copyright 2014 White Fir Design

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; only version 2 of the License is applicable.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Block direct access to the file
if ( !function_exists( 'add_action' ) ) { 
	exit; 
} 


//Initiate localization
function automatic_plugin_updates_init() {
	load_plugin_textdomain( 'automatic-plugin-updates', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('init', 'automatic_plugin_updates_init');


//Check if plugin to be automatically updated is set to be excluded from automatic updates
function check_if_excluded_plugin ($update,$item) {

	if (get_option('automatic_plugin_updates_excluded_plugins'))
		$excluded_plugins = get_option('automatic_plugin_updates_excluded_plugins');
	else
		return true;
	
	//Starting with WordPress 3.8.2 all plugin data is included in $item
	if (version_compare(get_bloginfo('version'),'3.8.2','>='))
		$plugin_to_check = $item->plugin;
	else
		$plugin_to_check = $item;
	
    if (in_array($plugin_to_check,$excluded_plugins))
        return false;
    else 
		return true;
}

//Enable automatic plugin updates while checking for excluded plugins
add_filter( 'auto_update_plugin', 'check_if_excluded_plugin', 10, 2 );

//Send email on plugin update
if ( (!get_option('automatic_plugin_updates_send_emails')) || ( get_option('automatic_plugin_updates_send_emails') && (get_option('automatic_plugin_updates_send_emails')=='enabled') ) )
	add_filter( 'automatic_updates_send_debug_email', '__return_true' );

//Adds settings link to menu
function automatic_plugin_updates_add_pages() {
	add_options_page( 'Automatic Plugin Updates', 'Automatic Plugin Updates', 'manage_options', 'automatic-plugin-updates', 'automatic_plugin_updates_page'	);
}
add_action( 'admin_menu', 'automatic_plugin_updates_add_pages' );


//Setting page
function automatic_plugin_updates_page() {

	//Store submitted data
	if ( ($_SERVER['REQUEST_METHOD'] === 'POST') && wp_verify_nonce($_POST['automatic_plugin_updates'],'automatic_plugin_updates') ) {
		
		//Store excluded plugins
		$excluded_plugins = array();
		foreach ($_POST as  $key => $val) {
			if (strpos($key,'_php'))
				$excluded_plugins[] = str_replace ('_php','.php',$key);
		}	
		update_option( 'automatic_plugin_updates_excluded_plugins', $excluded_plugins, '', 'yes' );
		
		//Store email preference
		update_option( 'automatic_plugin_updates_send_emails', $_POST['send-email'], '', 'yes' );
	}
	else if (get_option('automatic_plugin_updates_excluded_plugins')) {
		$excluded_plugins = get_option('automatic_plugin_updates_excluded_plugins');
	}
	
	$current_plugins = get_plugins();
	
	echo '<div class="wrap">';
	echo '<h2>Automatic Plugin Updates</h2><p>';

	echo '<table class="form-table">';
	echo '<tr valign="top">';
	echo '<th scope="row">'.__('Disable Automatic Plugin Updates For', 'automatic-plugin-updates').'</th>';
	echo '<td><fieldset>';
	echo '<form  action="options-general.php?page=automatic-plugin-updates" method="post">';
	foreach ($current_plugins as  $key => $val) {
		echo '<input type="checkbox" name="';
		echo $key;
		echo '"';
		if (isset($excluded_plugins) && in_array ($key, $excluded_plugins))
			echo 'checked ';
		echo '><label for="';
		echo $key;
		echo '">';
		echo $val["Name"];
		echo '</label><br><br>';
	}
	echo '</fieldset></td>';
	echo '</tr>';
	echo '</table>';
	
	echo '<table class="form-table">';
	echo '<tr valign="top">';
	echo '<th scope="row"><label for="send-email">'.__('Send Email for Automatic Updates', 'automatic-plugin-updates' ).'</label></th>';
	echo '<td><fieldset>';
	echo '<select name="send-email"><option value="enabled">';
	echo __('Enabled', 'automatic-plugin-updates' );
	echo '</option><option value="disabled"';
	if ( get_option('automatic_plugin_updates_send_emails') && (get_option('automatic_plugin_updates_send_emails')=='disabled') )
		echo 'selected';
	echo '>';
	echo __('Disabled', 'automatic-plugin-updates' );
	echo '</option></select>';
	echo '</fieldset></td>';
	echo '</tr>';
	echo '</table>';

	
	wp_nonce_field('automatic_plugin_updates','automatic_plugin_updates');
	echo '<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>';
	echo '</form> ';

}

//Adds settings link on Installed Plugins page
function automatic_plugin_updates_settings_link($links) { 
  $diagnostic_test = '<a href="options-general.php?page=automatic-plugin-updates">'.__( 'Settings', 'automatic-plugin-updates' ).'</a>'; 
  array_unshift( $links, $diagnostic_test ); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter( "plugin_action_links_$plugin", 'automatic_plugin_updates_settings_link' );