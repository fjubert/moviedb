<?php
function set_movie_fields( $api_results, $post_id ) {

    //Set ACF - Fields
    $movie_fields = [
        'field_61a0200c0dc59' => 'movie_trailer',
        'field_61a020160dc5a' => 'movie_poster',
        'field_61a0d96248b3f' => 'release_date',
        'field_61a0d9b348b40' => 'original_language',
        'field_61a0d9f648b41' => 'popularity',
        'field_61a020840dc5d' => 'overview',
        'field_61a020430dc5c' => 'alternative_titles',
        'field_61a0209c0dc5e' => 'production_companies',
        'field_61a0da1a48b43' => 'recommendations',
        'field_61a0da0a48b42' => 'reviews',
        'field_61a0da7c48b44' => 'cast'
    ];

    //Set Actors
    include_once('set-actors.php');

    foreach( $movie_fields as $key => $name ) {
        if( $name === 'movie_trailer' ) {
            $videos_results = $api_results->videos->results;
            if( count( $videos_results ) > 0 ) {
                foreach( $videos_results as $video) {
                    if( $video -> type === 'Trailer' ) {
                        $value = 'https://www.youtube.com/watch?v=' . $video -> key;
                        break;
                    }
                }
            } else { 
                $value = ''; 
            }
            update_field( $key, $value, $post_id );
        
        } elseif( $name === 'movie_poster' ) {
            $value = 'https://image.tmdb.org/t/p/w500' . $api_results->poster_path;
            update_field( $key, $value, $post_id );

        } elseif( $name === 'alternative_titles' ) {
            $a_titles = $api_results->alternative_titles->titles;
            if( count(  $a_titles ) > 0 ) {
                $value = [];
                foreach( $a_titles as $a_title ) {
                    $titles_array = [
                        'field_61a0d57948b3b' => $a_title->iso_3166_1,
                        'field_61a0d58f48b3c' => $a_title->title
                    ];
                    array_push( $value, $titles_array );
                }
                update_field( $key, $value, $post_id );
            }

        } elseif( $name === 'production_companies' ) {
            $companies = $api_results->production_companies;
            if( count(  $companies ) > 0 ) {
                $value = [];
                foreach( $companies as $company ) {
                    $company_array = [
                        'field_61a0d90748b3d' => 'https://image.tmdb.org/t/p/w300' . $company->logo_path,
                        'field_61a0d94648b3e' => $company->name
                    ];
                    array_push( $value, $company_array );
                }
                update_field( $key, $value, $post_id );
            }

        } elseif( $name === 'reviews' ) {
            $reviews = $api_results->reviews->results;
            if( count( $reviews ) > 0 ) {
                $value = [];
                foreach( $reviews as $review ) {
                    $reviews_array = [
                        'field_61a1707d25f12' => $review->author,
                        'field_61a170cf25f14' => $review->author_details->rating,
                        'field_61a170fc25f15' => $review->content
                    ];
                    array_push( $value, $reviews_array );
                }
                update_field( $key, $value, $post_id );
            }

        } elseif( $name === 'recommendations' ) {
            $recommendations = $api_results->recommendations->results;
            if( count( $recommendations ) > 0 ) {
                $value = [];
                foreach( $recommendations as $recommendation ) {
                    $recommendation_slug = sanitize_title( $recommendation->original_title . '-' . $recommendation->id );
                    $recommendations_array = [
                        'field_61a1725325f16' => $recommendation_slug
                    ];
                    array_push( $value, $recommendations_array );
                }
                update_field( $key, $value, $post_id );
            }
        } elseif( $name === 'cast' ) {
            $cast = $api_results->credits->cast;
            if( count( $cast ) > 0 ) {
                $c = 0;
                $value = []; 
                foreach( $cast as $actor ) {
                    $actor_id = set_actors($actor);

                    if( $c > 6 ) {
                        break;
                    }
                    $c++;
                    array_push( $value, $actor_id );
                }
                update_field( $key, $value, $post_id );
            }
        } else {
            $value = $api_results->$name;
            update_field( $key, $value, $post_id );
        }
    }
}