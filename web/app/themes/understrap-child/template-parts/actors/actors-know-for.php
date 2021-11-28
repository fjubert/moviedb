<?php 

$actor_movies = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'movie',
    'meta_key'      => 'release_date',
    'order'         => 'DESC',
    'orderby'       => 'meta_value',
	'meta_query' => array(
		array(
			'key' => 'cast', // name of custom field
			'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
			'compare' => 'LIKE'
		)
	)
));

if( count( $actor_movies ) ) : ?>
    <h2 class="mb-3 mt-3">Known For</h2>
    <div class="grid-container">
        <?php 
            foreach( $actor_movies as $actor_movie ) { 
            setup_postdata( $actor_movie );

        ?>
        <div class="align-items-stretch d-flex mx-2 mb-4">
            <?php get_template_part( 'template-parts/movies/movie-card', null, $actor_movie->ID ); ?>
        </div>
        <?php	
            }
            wp_reset_postdata();
        ?>
    </div>
<?php endif; ?>
