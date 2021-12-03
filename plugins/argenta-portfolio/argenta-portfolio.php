<?php
/*
	Plugin Name: Argenta Portfolio
	Plugin URI: http://argenta.colabr.io/
	Description: Create and add personal portfolio to your website with Argenta theme.
	Version: 2.4
	Author: colabrio
	Author URI: http://argenta.colabr.io/
*/

/*  Copyright 2016 colabrio (email: team@colabr.io)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'plugins_loaded', 'argenta_portfolio_load_plugin_textdomain' );
 
function argenta_portfolio_load_plugin_textdomain() {
	load_plugin_textdomain( 'argenta_portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}


add_action( 'init', 'argenta_portfolio_register_my_cpts' );

function argenta_portfolio_register_my_cpts() {
	$labels = array(
		"name" => __( 'Portfolio', 'argenta_portfolio' ),
		"singular_name" => __( 'Portfolio', 'argenta_portfolio' ),
		"menu_name" => __( 'Portfolio', 'argenta_portfolio' ),
		"all_items" => __( 'All Projects', 'argenta_portfolio' ),
		"add_new" => __( 'Add New', 'argenta_portfolio' ),
		"add_new_item" => __( 'Add New Portfolio Project', 'argenta_portfolio' ),
		"edit_item" => __( 'Edit Project', 'argenta_portfolio' ),
		"new_item" => __( 'New Portfolio Project', 'argenta_portfolio' ),
		"view_item" => __( 'View Project', 'argenta_portfolio' ),
		"search_items" => __( 'Search Projects', 'argenta_portfolio' ),
		"not_found" => __( 'No projects found', 'argenta_portfolio' ),
		"not_found_in_trash" => __( 'No projects found in Trash', 'argenta_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'argenta_portfolio' ),
		"featured_image" => __( 'Featured image for this project', 'argenta_portfolio' ),
		"set_featured_image" => __( 'Set featured image for this project', 'argenta_portfolio' ),
		"remove_featured_image" => __( 'Remove featured image for this project', 'argenta_portfolio' ),
		"use_featured_image" => __( 'Use featured image for this project', 'argenta_portfolio' ),
		"archives" => __( 'Portfolio projects archive', 'argenta_portfolio' ),
		"insert_into_item" => __( 'Insert into project', 'argenta_portfolio' ),
		"uploaded_to_this_item" => __( 'Upload to this project', 'argenta_portfolio' ),
		"filter_items_list" => __( 'Filter projects', 'argenta_portfolio' ),
		"items_list_navigation" => __( 'Portfolio projects list navigation', 'argenta_portfolio' ),
		"items_list" => __( 'Portfolio projects list', 'argenta_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'argenta_portfolio' ),
	);

	$args = array(
		"label" => __( 'Portfolio', 'argenta_portfolio' ),
		"labels" => $labels,
		"description" => __( "Portfolio post type for Argenta theme.", "argenta" ),
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title", "comments", "editor", "thumbnail", "revisions" ),
	);

	register_post_type( "argenta_portfolio", $args );
}



add_action( 'init', 'argenta_portfolio_register_my_cpts_portfolio' );

function argenta_portfolio_register_my_cpts_portfolio() {
	$labels = array(
		"name" => __( 'Portfolio', 'argenta_portfolio' ),
		"singular_name" => __( 'Project', 'argenta_portfolio' ),
		"menu_name" => __( 'Portfolio', 'argenta_portfolio' ),
		"all_items" => __( 'All Projects', 'argenta_portfolio' ),
		"add_new" => __( 'Add New', 'argenta_portfolio' ),
		"add_new_item" => __( 'Add New Portfolio Project', 'argenta_portfolio' ),
		"edit_item" => __( 'Edit Project', 'argenta_portfolio' ),
		"new_item" => __( 'New Portfolio Project', 'argenta_portfolio' ),
		"view_item" => __( 'View Project', 'argenta_portfolio' ),
		"search_items" => __( 'Search Projects', 'argenta_portfolio' ),
		"not_found" => __( 'No projects found', 'argenta_portfolio' ),
		"not_found_in_trash" => __( 'No projects found in Trash', 'argenta_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'argenta_portfolio' ),
		"featured_image" => __( 'Featured image for this project', 'argenta_portfolio' ),
		"set_featured_image" => __( 'Set featured image for this project', 'argenta_portfolio' ),
		"remove_featured_image" => __( 'Remove featured image for this project', 'argenta_portfolio' ),
		"use_featured_image" => __( 'Use featured image for this project', 'argenta_portfolio' ),
		"archives" => __( 'Portfolio projects archive', 'argenta_portfolio' ),
		"insert_into_item" => __( 'Insert into project', 'argenta_portfolio' ),
		"uploaded_to_this_item" => __( 'Upload to this project', 'argenta_portfolio' ),
		"filter_items_list" => __( 'Filter projects', 'argenta_portfolio' ),
		"items_list_navigation" => __( 'Portfolio projects list navigation', 'argenta_portfolio' ),
		"items_list" => __( 'Portfolio projects list', 'argenta_portfolio' ),
		"parent_item_colon" => __( 'Parent Portfolio:', 'argenta_portfolio' ),
	);

	$args = array(
		"label" => __( 'Portfolio', 'argenta_portfolio' ),
		"labels" => $labels,
		"description" => __( "Portfolio post type for Argenta theme.", "argenta" ),
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-portfolio",
		"supports" => array( "title" ),
	);
	register_post_type( "argenta_portfolio", $args );
}




function argenta_portfolio_category_init() {
	$labels = array(
		'name' => _x( 'Categories', 'taxonomy general name', 'argenta_portfolio' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'argenta_portfolio' ),
		'search_items' => __( 'Search Categories', 'argenta_portfolio' ),
		'popular_items' => __( 'Popular Categories', 'argenta_portfolio' ),
		'all_items' => __( 'Categories', 'argenta_portfolio' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Category', 'argenta_portfolio' ),
		'update_item' => __( 'Update Category', 'argenta_portfolio' ),
		'add_new_item' => __( 'Add New Category', 'argenta_portfolio' ),
		'new_item_name' => __( 'New Portfolio Category', 'argenta_portfolio' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'argenta_portfolio' ),
		'add_or_remove_items' => __( 'Add or remove categories', 'argenta_portfolio' ),
		'choose_from_most_used' => __( 'Choose from the most used categories', 'argenta_portfolio' ),
		'not_found' => __( 'No categories found.', 'argenta_portfolio' ),
		'menu_name' => __( 'Categories', 'argenta_portfolio' ),
	);

	$args = array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_category' ),
	);

	register_taxonomy( 'argenta_portfolio_category', array( 'argenta_portfolio' ), $args );
}

add_action( 'init', 'argenta_portfolio_category_init' );


function argenta_portfolio_flush() {
	flush_rewrite_rules(); // Fix 404 page on projects. Flush rules
}

register_activation_hook( __FILE__, 'argenta_portfolio_flush' );

?>