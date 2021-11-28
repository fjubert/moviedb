<?php
//Set Genres
function add_movie_genres( $genres, $movie_id ) {
    $genres_to_set = [];
    foreach( $genres as $genre ) {
        $genre_slug = sanitize_title( $genre->name );
        $genre_term = term_exists( $genre_slug, 'movie_genre' );
        if( !$genre_term ) {
            $genre_term = wp_insert_term( 
                $genre->name,
                'movie_genre',
                array(
                    'slug' => $genre_slug
                )
            );
    
        }
        array_push( $genres_to_set, $genre->name );
    }

    wp_set_post_terms( $movie_id, $genres_to_set, 'movie_genre');
}