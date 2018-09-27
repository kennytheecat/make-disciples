<?php
function mdvp_enable_cpts( ) {
	
	$options = get_option( 'mdvp_settings' );
	
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



add_action( 'update_option_mdvp_settings', 'mdvp_check_if_listed', 10, 3 );


function mdvp_check_if_listed( $old_value, $new_value, $option  ) {
	
	ob_start();
	
	print_r($old_value);
	print_r($new_value);
		
	$sources = array ( 'article', 'podcast', 'video' );
	
	foreach ( $sources as $source ) {
	
		if ( isset( $old_value['mdvp_' . $source . 's_list'] ) && ! empty( $old_value['mdvp_' . $source . 's_list'] ) ) {
			$presave = $old_value['mdvp_' . $source . 's_list'];
		} else {
			$presave = array();
		}
		
		if ( isset( $new_value['mdvp_' . $source . 's_list'] ) && ! empty( $new_value['mdvp_' . $source . 's_list'] ) ) {
			$postsave = $new_value['mdvp_' . $source . 's_list'];
		} else {
			$postsave = array();
		}		
		
		echo 'presave ' . $source . ': ';
			print_r($presave);

		echo 'postsave ' . $source . ': ';
			print_r($postsave);
			
			
			// add or update
			if ( array_diff($postsave, $presave) ) {
					$diff = array_diff($postsave, $presave);
					print_r($diff);			

					foreach ( $diff as $post_id ) {
						//if ( in_array( $post_id, $postsave ) ) {
							mdvp_update_post( $post_id, $source );
						//}						
					}
					
			}
			
			// delete
				if ( array_diff($presave, $postsave) ) {
					$diff = array_diff($presave, $postsave);
					print_r($diff);
					
					foreach ( $diff as $post_id ) {
						//if ( in_array( $post_id, $postsave ) ) {
							mdvp_delete_post( $post_id, $source );
						//}						
					}
				}
			

			/*
			foreach ($items as $item ) {
				// Check if already listed
				$post_id = $item;
				$source = $source;
				
				$connected_to = get_option( 'connected_to');
				if ( empty($connected_to)) { $connected_to = array(); }
				if ( in_array( $post_id, $connected_to) ) {
					//do nothing
				} else {

				// Check if has current update
				
				
				// Insert post or update
					//mdvp_update_post( $post_id, $source );
				}
			}
			*/
		//}
	} // end foreach
	$content = ob_get_contents();
	ob_end_clean();
	$file = file_put_contents('/wamp64/www/plugintest/wp-content/themes/plugin-test/inc/make-disciples/herewegoo.txt', $content);
}

function mdvp_update_post( $source_post_id, $source ) {
	echo 'made it';
	//get json data for post by id
	$url = 'http://theorthodoxfaith.com/wp-json/wp/v2/' . $source . '/' . $source_post_id . '/';
	$response = wp_remote_get( $url );
	$results = json_decode( wp_remote_retrieve_body( $response ), true );	
	
	$args = array(
		'post_title'    => $results['title']['rendered'],
		'post_content'  => $results['content']['rendered'],
		'post_status'   => 'publish',
		'post_type'			=> $source
	);
	$wp_post_id = wp_insert_post( $args );
	
	// add old post id to post meta as an identifier
	$connected_to = get_option( 'connected_to');
	$connected_to[$source_post_id] = $wp_post_id;
	update_option( 'connected_to', $connected_to);
	
}


function mdvp_delete_post( $source_post_id, $source ) {
	
	$connected_to = get_option( 'connected_to');
	$to_delete_id = $connected_to[$source_post_id];
	wp_delete_post( $to_delete_id, true );
	
	
	unset($connected_to[$source_post_id]);
	update_option( 'connected_to', $connected_to);
	
	
}
?>