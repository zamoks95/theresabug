<?php

// Register sidebars
register_sidebar( array(
	'name' => esc_html__( 'Blog', 'argenta' ),
	'id' => 'argenta-sidebar-blog',
	'description' => esc_html__( 'Add widgets here.', 'argenta' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget' => '</section>',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => esc_html__( 'Pages', 'argenta' ),
	'id' => 'argenta-sidebar-page',
	'description' => esc_html__( 'Add widgets here.', 'argenta' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget' => '</section>',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => esc_html__( 'Footer column 1', 'argenta' ),
	'id' => 'argenta-sidebar-footer-1',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 2', 'argenta' ),
	'id' => 'argenta-sidebar-footer-2',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 3', 'argenta' ),
	'id' => 'argenta-sidebar-footer-3',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 4', 'argenta' ),
	'id' => 'argenta-sidebar-footer-4',
	'before_title' => '<h3 class="title widgettitle">',
	'after_title' => '</h3>',
));