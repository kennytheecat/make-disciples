<?php
// Register Custom Post Type
function cpt_articles() {

	$labels = array(
		'name'                  => _x( 'Articles', 'Post Type General Name', 'theorthodoxfaith' ),
		'singular_name'         => _x( 'Article', 'Post Type Singular Name', 'theorthodoxfaith' ),
		'menu_name'             => __( 'Articles', 'theorthodoxfaith' ),
		'name_admin_bar'        => __( 'Article', 'theorthodoxfaith' ),
		'archives'              => __( 'Item Archives', 'theorthodoxfaith' ),
		'attributes'            => __( 'Item Attributes', 'theorthodoxfaith' ),
		'parent_item_colon'     => __( 'Parent Item:', 'theorthodoxfaith' ),
		'all_items'             => __( 'All Items', 'theorthodoxfaith' ),
		'add_new_item'          => __( 'Add New Item', 'theorthodoxfaith' ),
		'add_new'               => __( 'Add New', 'theorthodoxfaith' ),
		'new_item'              => __( 'New Item', 'theorthodoxfaith' ),
		'edit_item'             => __( 'Edit Item', 'theorthodoxfaith' ),
		'update_item'           => __( 'Update Item', 'theorthodoxfaith' ),
		'view_item'             => __( 'View Item', 'theorthodoxfaith' ),
		'view_items'            => __( 'View Items', 'theorthodoxfaith' ),
		'search_items'          => __( 'Search Item', 'theorthodoxfaith' ),
		'not_found'             => __( 'Not found', 'theorthodoxfaith' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'theorthodoxfaith' ),
		'featured_image'        => __( 'Featured Image', 'theorthodoxfaith' ),
		'set_featured_image'    => __( 'Set featured image', 'theorthodoxfaith' ),
		'remove_featured_image' => __( 'Remove featured image', 'theorthodoxfaith' ),
		'use_featured_image'    => __( 'Use as featured image', 'theorthodoxfaith' ),
		'insert_into_item'      => __( 'Insert into item', 'theorthodoxfaith' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'theorthodoxfaith' ),
		'items_list'            => __( 'Items list', 'theorthodoxfaith' ),
		'items_list_navigation' => __( 'Items list navigation', 'theorthodoxfaith' ),
		'filter_items_list'     => __( 'Filter items list', 'theorthodoxfaith' ),
	);
	$args = array(
		'label'                 => __( 'Article', 'theorthodoxfaith' ),
		'description'           => __( 'Article Description', 'theorthodoxfaith' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'category', 'post_tag', 'subject' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'articles',		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'article', $args );

}
?>