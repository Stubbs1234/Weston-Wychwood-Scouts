<?php 
if( !defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) 
	exit;
delete_option('automatic_plugin_updates_excluded_plugins');
delete_option('automatic_plugin_updates_send_emails');