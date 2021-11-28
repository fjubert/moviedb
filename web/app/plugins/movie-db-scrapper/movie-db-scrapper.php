<?php
/*
    Plugin Name: The Movie DB Scrapper
    Plugin URI: https://www.enovathemes.com
    Description: Scrapp data from The Movie DB and post to wordpress
    Author: Felipe Jubert
    Version: 1.0
    Author URI: https://github.com/fjubert/moviesdb
*/
 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_nopriv_get_movies_from_api', 'get_movies_from_api');
add_action('wp_ajax_get_movies_from_api', 'get_movies_from_api');

function get_movies_from_api() {
    $current_page = ( ! empty($_POST['current_page']) ) ? $_POST['current_page'] : 1;

    $url = 'https://api.themoviedb.org/3';
    $api_key = '?api_key=' . getenv('API_KEY');

    $results = wp_remote_retrieve_body(
        wp_remote_get($url . '/discover/movie' . $api_key . '&page=' . $current_page)
    );

    $results = json_decode($results);

    if( ! is_array( $results->results ) || empty( $results->results ) ) {
        return false;
    }

    $movies = $results->results;

    foreach( $movies as $movie ) {
        $movie_slug = sanitize_title($movie->original_title . '-' . $movie->id);

        $inserted_movie = wp_insert_post([
            'post_name'   => $movie_slug,
            'post_title'  => $movie->original_title,
            'post_type'   => 'movie',
            'post_status' => 'publish'
        ]);

        $movie_details = wp_remote_retrieve_body(
            wp_remote_get($url . '/movie'. '/'. $movie->id . $api_key . '&append_to_response=videos,alternative_titles,credits,reviews,recommendations')
        );

        $movie_details = json_decode($movie_details);

        if( is_wp_error( $inserted_movie ) ) {
            continue;
        }

        //Set Genres
        include_once('includes/add-genres.php');
        
        $genres = $movie_details->genres;

        add_movie_genres( $genres, $inserted_movie );

        //Set Movie Fields
        include_once('includes/set-movie-fields.php');

        set_movie_fields( $movie_details, $inserted_movie );
        
    }

    $current_page = $current_page + 1;

    wp_remote_post( admin_url('admin-ajax.php?action=get_movies_from_api'), [
        'blocking' => false,
        'sslverify' => false,
        'body' => [
            'current_page' => $current_page,
        ]
    ]);
}