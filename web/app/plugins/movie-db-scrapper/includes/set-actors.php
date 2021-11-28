<?php 
include_once('post-exists-by-slug.php');
function set_actors($actor) {
    $actor_slug = sanitize_title( $actor->name . '-'. $actor->id);

    $actor_id = post_exists_by_slug($actor_slug, 'actor');

    if( !$actor_id ) {
        $url = 'https://api.themoviedb.org/3';
        $api_key = '?api_key=' . getenv('API_KEY');

        $actor_data = wp_remote_retrieve_body(
            wp_remote_get($url . '/person' . '/' . $actor->id . $api_key . '&append_to_response=movie_credits,images')
        );
    
        $actor_data = json_decode($actor_data);

        $actor_id = wp_insert_post([
            'post_name'   => $actor_slug,
            'post_title'  => $actor->name,
            'post_type'   => 'actor',
            'post_status' => 'publish'
        ]);

        //Set ACF - Fields
        $actor_fields = [
            'field_61a188b95dbb6' => 'profile_picture',
            'field_61a188d25dbb7' => 'name',
            'field_61a188e05dbb8' => 'birthday',
            'field_61a189095dbb9' => 'place_of_birth',
            'field_61a189155dbba' => 'deathday',
            'field_61a189435dbbc' => 'popularity',
            'field_61a1894e5dbbd' => 'biography',
            'field_61a189585dbbe' => 'gallery',
            'field_61a20d9b48a30' => 'related_movies'
        ];

        foreach( $actor_fields as $key => $name ) {
            if( $name === 'profile_picture' ) {
                $value = 'https://image.tmdb.org/t/p/h632' . $actor_data->profile_path;
                update_field( $key, $value, $actor_id );
            } elseif ( $name === 'gallery' ) {
                $gallery = $actor_data->images->profiles;
                if( count(  $gallery ) > 0 ) {
                    $value = [];
                    $c = 0;
                    foreach($gallery as $image) {
                        $image_array = [
                            'field_61a1929fdfe29' => 'https://image.tmdb.org/t/p/h632' . $image->file_path,
                        ];
                        array_push( $value, $image_array );
                        if( $c > 10 ) {
                            break;
                        }
                        $c++;
                    }
                    update_field( $key, $value, $actor_id );
                }

            } else {
                $value = $actor_data->$name;
                update_field( $key, $value, $actor_id );
            }
        }
    }
    return $actor_id;
}