<?php

/**
 * Function calls go here. For example: custom post types,
 * sidebars, and the theme options panel are defined here.
 *  
 * Each section is marked and is coded in this order:
 * 		1. Theme Options Panel
 *		2. Menus
 *		3. Sidebars
 *		4. Script Calls
 *		5. Custom Post Types
 */
 
add_theme_support( 'automatic-feed-links' );
 
// 1. THEME OPTIONS PANEL

include( 'functions-theme-options.php' );

add_action('admin_menu', 'mytheme_add_admin');

// 2. MENU DEFINES

if (function_exists('add_theme_support')) {
	add_theme_support('nav-menus');
}

if(function_exists('register_nav_menu')) {
	register_nav_menu( 'main', 'Main Navigation');
}

// 3. SIDEBAR DEFINES

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

// 4. SCRIPT CALLS

/**
 * Loads jQuery, index.js, jquery.fancybox.js,
 * jquery.nivo.js, and jquery.tweetable.js
 * 
 * All scripts except for the main jQuery script
 * are located in the js folder of the theme folder
 */

if( !is_admin() ) {
	wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'dwp-cufon', get_template_directory_uri() . '/js/cufon.js', false, "1.09" );
	wp_enqueue_script( 'dwp-cufon' );
	
	wp_register_script( 'dwp-quicksand-font', get_template_directory_uri() . '/js/Quicksand_Book_400.font.js', false, "1.0" );
	wp_enqueue_script( 'dwp-quicksand-font' );
	
	wp_register_script( 'dwp-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox-1.3.4.js', false, "1.3.4" );
	wp_enqueue_script( 'dwp-fancybox' );
	
	wp_register_script( 'dwp-accordion', get_template_directory_uri() . '/js/jquery.accordion.js', false, "1.0" );
	wp_enqueue_script( 'dwp-accordion' );
	
	wp_register_script( 'dwp-dropdown', get_template_directory_uri() . '/js/dropdown.js', false, "1.0" );
	wp_enqueue_script( 'dwp-dropdown' );
	
	wp_register_script( 'dwp-innerfade', get_template_directory_uri() . '/js/jquery.innerfade.js', false, "1.0" );
	wp_enqueue_script( 'dwp-innerfade' );
	
	wp_register_script( 'dwp-twitter', get_template_directory_uri() . '/js/jquery.tweetable.js', false, "1.6" );
	wp_enqueue_script( 'dwp-twitter' );
	
	wp_register_script( 'dwp-index', get_template_directory_uri() . '/js/index.js', false, '1.0' );
	wp_enqueue_script( 'dwp-index' );
}

/**
 * These are loaded for the admin panel 
 * which is why they aren't included above
 */

function dwp_add_init() {
	wp_enqueue_style( "dwp-functions-style", get_template_directory_uri() . "/functions/functions.css", false, "1.0", "all" );
	wp_enqueue_script( "dwp-functions-script", get_template_directory_uri() . "/functions/functions.js", false, "1.0" );
}

add_action( 'admin_init', 'dwp_add_init' );

// 5. CUSTOM POST TYPES

/**
 * All custom post types are located in
 * functions-post-types.php
 */

include( 'functions-post-types.php' );
?>