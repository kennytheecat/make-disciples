<?php // MyPlugin - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// register plugin settings
function mdvp_register_settings() {
	
	/*
	
	register_setting( 
		string   $option_group, 
		string   $option_name, 
		callable $sanitize_callback = ''
	);
	
	*/
	
	register_setting( 
		'mdvp_options', 
		'mdvp_options'
	); 
	
	/*
	
	add_settings_section( 
		string   $id, 
		string   $title, 
		callable $callback, 
		string   $page
	);
	
	*/
	
	add_settings_section( 
		'mdvp_section_login', 
		esc_html__('Step One', 'mdvp'), 
		'mdvp_callback_section_login', 
		'mdvp_options'
	);
	
	/*
	
	add_settings_field(
    string   $id, 
		string   $title, 
		callable $callback, 
		string   $page, 
		string   $section = 'default', 
		array    $args = []
	);
	
	*/
	
	add_settings_field(
		'mdvp_sources',
		esc_html__('Sources', 'mdvp'),
		'mdvp_callback_field_checkboxes',
		'mdvp_options',
		'mdvp_section_login', 
		[ 'id' => 'mdvp_sources', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp') ]
	);

	add_settings_field(
		'mdvp_articles_list',
		esc_html__('Articles', 'mdvp'),
		'mdvp_callback_articles_list',
		'mdvp', 
		'mdvp_section_login', 
		[ 'id' => 'mdvp_articles_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp') ]
	);
	
	add_settings_field(
		'mdvp_podcasts_list',
		esc_html__('Podcasts', 'mdvp'),
		'mdvp_callback_podcasts_list',
		'mdvp', 
		'mdvp_section_login', 
		[ 'id' => 'mdvp_podcasts_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp') ]
	);

	add_settings_field(
		'mdvp_videos_list',
		esc_html__('Videos', 'mdvp'),
		'mdvp_callback_videos_list',
		'mdvp', 
		'mdvp_section_login', 
		[ 'id' => 'mdvp_videos_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp') ]
	);	
	
} 
add_action( 'admin_init', 'mdvp_register_settings' );


