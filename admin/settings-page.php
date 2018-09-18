<?php // MyPlugin - Settings Page



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// display the plugin settings page
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

