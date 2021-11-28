<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts',  'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Custom Post Types
 * 
 * Movies
 */

add_action( 'init', 'register_movie_cpt');

function register_movie_cpt() {
	register_post_type('movie', [
        'label'            => 'Movies',
        'public'           => true,
        'supports'         => array( 'title' ),
        'capability_type'  => 'post',
		'has_archive'      => true
    ]);
}

add_action( 'init', 'register_actor_cpt');

function register_actor_cpt() {
	register_post_type('actor', [
        'label'            => 'Actors',
        'public'           => true,
        'supports'         => array( 'title' ),
        'capability_type'  => 'post',
		'has_archive'      => true
    ]);
}

add_action( 'init', 'register_genre_taxonomie' );

function register_genre_taxonomie() {
	register_taxonomy('movie_genre', ['movie'], [
		'label' => __('Genres'),
		'hierarchical' => false,
		'rewrite' => ['slug' => 'movie-genre'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Genre'),
			'all_items' => __('All Genres'),
			'edit_item' => __('Edit Genre'),
			'view_item' => __('View Genre'),
			'update_item' => __('Update Genre'),
			'add_new_item' => __('Add New Genre'),
			'new_item_name' => __('New Genre Name'),
			'search_items' => __('Search Genres'),
			'popular_items' => __('Popular Genres'),
			'separate_items_with_commas' => __('Separate genres with comma'),
			'choose_from_most_used' => __('Choose from most used genres'),
			'not_found' => __('No Genres found'),
		]
	]);
};
