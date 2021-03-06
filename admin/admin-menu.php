<?php // MyPlugin - Admin Menu



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// add sub-level administrative menu
function mdvp_add_sublevel_menu() {
	
	/*
	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug, 
		callable $function = ''
	);
	
	*/
	
	add_submenu_page(
		'options-general.php',
		esc_html__('MyPlugin Settings', 'mdvp'),
		esc_html__('MyPlugin', 'mdvp'),
		'manage_options',
		'mdvp_options',
		'mdvp_display_settings_page'
	);
	
}
//add_action( 'admin_menu', 'mdvp_add_sublevel_menu' );



// add top-level administrative menu
function mdvp_add_toplevel_menu() {
	
	/* 
	
	add_menu_page(
		string   $page_title, 
		string   $menu_title, 
		string   $capability, 
		string   $menu_slug, 
		callable $function = '', 
		string   $icon_url = '', 
		int      $position = null 
	)
	
	*/
	
	add_menu_page(
		esc_html__('MyPlugin Settings', 'mdvp'),
		esc_html__('MyPlugin', 'mdvp'),
		'manage_options',
		'mdvp_options',
		'mdvp_display_settings_page',
		'dashicons-admin-generic',
		null
	);
	
}
// add_action( 'admin_menu', 'mdvp_add_toplevel_menu' );

function mdvp_add_admin_menu(  ) { 

	add_options_page( 'Make Disciples', 'Make Disciples', 'manage_options', 'make_disciples', 'mdvp_sources_page' );

}
add_action( 'admin_menu', 'mdvp_add_admin_menu' );
