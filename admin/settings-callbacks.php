<?php // MyPlugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}



// callback: login section
function mdvp_callback_section_login() {
	
	echo '<p>'. esc_html__('Choose which sources you would like to add to the visitor plugin.', 'mdvp') .'</p>';
	
}



// callback: admin section
function mdvp_callback_section_admin() {
	
	echo '<p>'. esc_html__('These settings enable you to customize the WP Admin Area.', 'mdvp') .'</p>';
	
}



// callback: text field
function mdvp_callback_field_text( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	echo '<input id="mdvp_options_'. $id .'" name="mdvp_options['. $id .']" type="text" size="40" value="'. $value .'"><br />';
	echo '<label for="mdvp_options_'. $id .'">'. $label .'</label>';
	
}



// radio field options
function mdvp_options_radio() {
	
	return array(
		
		'articles'  => esc_html__('Articles', 'mdvp'),
		'podcasts' => esc_html__('Podcasts', 'mdvp'),
		'videos' => esc_html__('Videos', 'mdvp')
		
	);
	
}





// callback: radio field
function mdvp_callback_field_checkboxes( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
		
	$radio_options = mdvp_options_radio();
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_options['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}

// callback: radio field
function mdvp_callback_articles_list( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
		
	$radio_options = mdvp_options_create_list( 'Articles', 'article');
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_options['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}

// callback: radio field
function mdvp_callback_podcasts_list( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
		
	$radio_options = mdvp_options_create_list( 'Podcasts', 'podcast');
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_options['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}

// callback: radio field
function mdvp_callback_videos_list( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
		
	$radio_options = mdvp_options_create_list( 'Videos', 'video');
	
	foreach ( $radio_options as $value => $label ) {
		
		$checked = '';
		if ( isset( $options[$id] ) ) {
			$checked = checked((in_array($value, $options[$id])), true, false);
		}
		
		echo '<label><input name="mdvp_options['. $id .'][]" type="checkbox" value="'. $value .'"'. $checked .'> ';
		echo '<span>'. $label .'</span></label><br />';
		
	}
	
}

function mdvp_options_create_list( $title, $source ) {

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





// callback: textarea field
function mdvp_callback_field_textarea( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$allowed_tags = wp_kses_allowed_html( 'post' );
	
	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags ) : '';
	
	echo '<textarea id="mdvp_options_'. $id .'" name="mdvp_options['. $id .']" rows="5" cols="50">'. $value .'</textarea><br />';
	echo '<label for="mdvp_options_'. $id .'">'. $label .'</label>';
	
}



// callback: checkbox field
function mdvp_callback_field_checkbox( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$checked = isset( $options[$id] ) ? checked( $options[$id], 1, false ) : '';
	
	echo '<input id="mdvp_options_'. $id .'" name="mdvp_options['. $id .']" type="checkbox" value="1"'. $checked .'> ';
	echo '<label for="mdvp_options_'. $id .'">'. $label .'</label>';
	
}



// select field options
function mdvp_options_select() {
	
	return array(
		
		'default'   => esc_html__('Default',   'mdvp'),
		'light'     => esc_html__('Light',     'mdvp'),
		'blue'      => esc_html__('Blue',      'mdvp'),
		'coffee'    => esc_html__('Coffee',    'mdvp'),
		'ectoplasm' => esc_html__('Ectoplasm', 'mdvp'),
		'midnight'  => esc_html__('Midnight',  'mdvp'),
		'ocean'     => esc_html__('Ocean',     'mdvp'),
		'sunrise'   => esc_html__('Sunrise',   'mdvp'),
		
	);
	
}



// callback: select field
function mdvp_callback_field_select( $args ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	$id    = isset( $args['id'] )    ? $args['id']    : '';
	$label = isset( $args['label'] ) ? $args['label'] : '';
	
	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ) : '';
	
	$select_options = mdvp_options_select();
	
	echo '<select id="mdvp_options_'. $id .'" name="mdvp_options['. $id .']">';
	
	foreach ( $select_options as $value => $option ) {
		
		$selected = selected( $selected_option === $value, true, false );
		
		echo '<option value="'. $value .'"'. $selected .'>'. $option .'</option>';
		
	}
	
	echo '</select> <label for="mdvp_options_'. $id .'">'. $label .'</label>';
	
}


