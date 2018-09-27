<?php // MyPlugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// callback: radio field
function mdvp_sources_render( $args ) {
	
	//$options = get_option( 'mdvp_sources', mdvp_sources_default() );
	$options = get_option( 'mdvp_settings' );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
		
	$radio_options = mdvp_sources_radio();
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_settings['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}


// radio field options
function mdvp_sources_radio() {
	
	return array(
		
		'articles'  => esc_html__('Articles', 'mdvp'),
		'podcasts' => esc_html__('Podcasts', 'mdvp'),
		'videos' => esc_html__('Videos', 'mdvp')
		
	);
	
}

// callback: radio field
function mdvp_list_render( $args ) {
	
	$options = get_option( 'mdvp_settings' );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	$source = isset( $args['source'] ) ? $args['source'] : '';
		
	$radio_options = mdvp_settings_create_list( $source );
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_settings['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
	/*
	
	$presave = $options['mdvp_' . $source . 's_list'];
	$presave = implode(', ', $presave);
	echo '<label><input name="presave_' . $source . 's_list" type="hidden" value="'. $presave . '"> ';
	
	*/
	
}


function mdvp_settings_create_list( $source ) {

	//$sources = array ('Articles' => 'article', 'Podcasts' => 'podcast', 'Videos' => 'video' );
		
	$response = wp_remote_get( 'http://theorthodoxfaith.com/wp-json/wp/v2/' . $source . '?per_page=100' );
	//_embed&
		//$results = $odb->get_results("SELECT * from tof_posts WHERE post_type LIKE '$source'");
		$results = json_decode( wp_remote_retrieve_body( $response ), true );

		//echo '<h2>' . $title . '</h2>';
		//echo '<ul>';
		foreach ( $results as $result ) {
			//print_r($result);
			
			//echo '<li>' . $result['title']['rendered'] . ' (<a href="' . $result['link'] .'" target="_blank">View</a>)</li>';
		//echo '<p>' . $result->{"wp:featuredmedia"}->href . '</p>';
		//echo $result['_embedded']['wp:featuredmedia'][0]['source_url'];
		//print_r($result);
		$slug = $result['id'];
		$title = $result['title']['rendered'] . ' (<a href="' . $result['link'] .'" target="_blank">View</a>)';
		$selected_sources[$slug] = $title;	
	}
	return $selected_sources;
	
}


function mdvp_settings_section_callback(  ) { 

	echo __( 'This section description', 'icxc-nika.com' );

}



function mdvp_sources_page(  ) { 

//echo $file = file_put_contents('herewegoess.txt', "kennyss");

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	
		
	if ( isset($_POST['submit'] ) ) {
		//echo $file = file_put_contents(get_template_directory_uri() . '/inc/herewegoo.txt', 'bitches');
		
		//mdvp_check_if_listed();
	} 
	
	?>
	<form method='post' action='options.php'>
	<!--<form method='post'>-->

		<h2>Make Disciples</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>
