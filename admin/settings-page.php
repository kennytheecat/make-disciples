<?php // MyPlugin - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// display the plugin settings page
/*
function mdvp_display_settings_page() {
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
	if ( isset($_POST['submit'] ) ) {
		//mdvp_check_if_listed();
	} 
	
	?>
	
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form  method="post">
			
			<?php
			
			// output security fields
			settings_fields( 'mdvp_options' );
			
			// output setting sections
			do_settings_sections( 'mdvp_options' );
			
			// submit button
			submit_button();
			
			?>
			
		</form>
	</div>
	
	<?php
	
}


function connect_to_intermediary_db( ) {
    $db = new wpdb( 'thirdla2_visitor', 'CharlieChickens', 'thirdla2_ortho', 'theorthodoxfaith.com' );
    return $db;
}
*/
function mdvp_settings_init(  ) { 

	register_setting( 'pluginPage', 'mdvp_settings' );

	add_settings_section(
		'mdvp_pluginPage_section', 
		__( 'Your section description', 'icxc-nika.com' ), 
		'mdvp_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field(
		'mdvp_sources',
		esc_html__('Sources', 'mdvp'),
		'mdvp_sources_render',
		'pluginPage', 
		'mdvp_pluginPage_section',
		[ 'id' => 'mdvp_sources', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp') ]
	);
	
	add_settings_field(
		'mdvp_articles_list',
		esc_html__('Articles', 'mdvp'),
		'mdvp_list_render',
		'pluginPage', 
		'mdvp_pluginPage_section',
		[ 'id' => 'mdvp_articles_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp'), 'source' => 'article' ]
	);
	
	add_settings_field(
		'mdvp_podcasts_list',
		esc_html__('Podcasts', 'mdvp'),
		'mdvp_list_render',
		'pluginPage', 
		'mdvp_pluginPage_section',
		[ 'id' => 'mdvp_podcasts_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp'), 'source' => 'podcast' ]
	);

	add_settings_field(
		'mdvp_videos_list',
		esc_html__('Videos', 'mdvp'),
		'mdvp_list_render',
		'pluginPage', 
		'mdvp_pluginPage_section',
		[ 'id' => 'mdvp_videos_list', 'label' => esc_html__('Custom CSS for the Login screen', 'mdvp'), 'source' => 'video' ]
	);

	

}
add_action( 'admin_init', 'mdvp_settings_init' );