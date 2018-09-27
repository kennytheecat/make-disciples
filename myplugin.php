<?php
/*
Plugin Name:  Make Disciples Visitor Plugin
Description:  Example plugin for the video tutorial series, "WordPress: Plugin Development", available at Lynda.com.
Plugin URI:   https://profiles.wordpress.org/specialk
Author:       Jeff Starr
Version:      1.0
Text Domain:  mdvp
Domain Path:  /languages
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// load text domain
function mdvp_load_textdomain() {

	load_plugin_textdomain( 'mdvp', false, plugin_dir_path( __FILE__ ) . 'languages/' );

}
add_action( 'plugins_loaded', 'mdvp_load_textdomain' );



// include plugin dependencies: admin only
if ( is_admin() ) {

	require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';

	// Custom Post Types
	require_once plugin_dir_path( __FILE__ ) . 'admin/cpt/cpt-articles.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/cpt/cpt-podcasts.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/cpt/cpt-videos.php';
	
	require_once plugin_dir_path( __FILE__ ) . 'admin/mdvp-load.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/mdvp-visitor_section.php';
	
	require_once plugin_dir_path( __FILE__ ) . 'example-functions.php';

	
}



// include plugin dependencies: admin and public
//require_once plugin_dir_path( __FILE__ ) . 'includes/core-functions.php';





// default plugin options
function mdvp_options_default() {

	return array(
		'custom_url'     => 'https://wordpress.org/',
		'custom_title'   => esc_html__('Powered by WordPress', 'mdvp'),
		'custom_style'   => 'disable',
		'custom_message' => '<p class="custom-message">'. esc_html__('My custom message', 'mdvp') .'</p>',
		'custom_footer'  => esc_html__('Special message for users', 'mdvp'),
		'custom_toolbar' => false,
		'custom_scheme'  => 'default',
	);

}


