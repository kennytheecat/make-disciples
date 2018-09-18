<?php // MyPlugin - Core Functionality



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	
	exit;
	
}


// Enable CPT's
function mdvp_enable_cpts( ) {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	if ( isset( $options['mdvp_sources'] ) && ! empty( $options['mdvp_sources'] ) ) {

		if ( in_array('articles', $options['mdvp_sources'] ) ) {
			cpt_articles();
		}
		
		if ( in_array('podcasts', $options['mdvp_sources'] ) ) {
			cpt_podcasts();
		}

		if ( in_array('videos', $options['mdvp_sources'] ) ) {
			cpt_videos();
		}
		
	}
	
}
add_action( 'init', 'mdvp_enable_cpts' );

function mdvp_check_if_listed() {
	
	$options = get_option( 'mdvp_options', mdvp_options_default() );
	
	if ( isset( $options['mdvp_sources_list'] ) && ! empty( $options['mdvp_sources_list'] ) ) {

	$items =  $options['mdvp_sources_list'];
	
	foreach ($items as $item ) {
	// Check if already listed
	$post_id = $item;
	$source = 'article';
	
	$connected_to = get_option( 'connected_to');
	if ( empty($connected_to)) { $connected_to = array(); }
	if ( in_array( $post_id, $connected_to) ) {
		//do nothing
	} else {

	// Check if has current update
	
	
	// Insert post or update
	
		
		mdvp_update_post( $post_id, $source );
	}
	}
	}
	
}
//add_action( 'update_option_mdvp_sources_list', 'mdvp_check_if_listed', 10, 2 );

function mdvp_update_post( $post_id, $source ) {
	
	//get json data for post by id
	$url = 'http://theorthodoxfaith.com/wp-json/wp/v2/' . $source . '/' . $post_id . '/';
	$response = wp_remote_get( $url );
	$results = json_decode( wp_remote_retrieve_body( $response ), true );	
	
	$args = array(
		'post_title'    => $results['title']['rendered'],
		'post_content'  => $results['content']['rendered'],
		'post_status'   => 'publish',
		'post_type'			=> 'article'
	);
	$new_post_id = wp_insert_post( $args );
	
	// add old post id to post meta as an identifier
	$connected_to = get_option( 'connected_to');
	$connected_to[$new_post_id] = $post_id;
	update_option( 'connected_to', $connected_to);
	
}