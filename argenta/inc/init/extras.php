<?php

function cbrio_init_body_classes( $classes ) {

    $classes[] = 'theme-argenta-2-0-6';

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}

add_filter( 'body_class', 'cbrio_init_body_classes' );



function cbrio_init_jetpack() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'argenta_lh_jetpack_infinite_render',
		'footer'    => 'page',
	) );
	add_theme_support( 'jetpack-responsive-videos' );
}

function argenta_lh_jetpack_infinite_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
		    get_template_part( 'template-parts/content', 'search' );
		} else {
		    get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}

add_action( 'after_setup_theme', 'cbrio_init_jetpack' );
