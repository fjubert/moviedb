<?php
$next_month_date = date('Y-m-d', strtotime('+1 month'));
$current_month = date('m');
$current_year = date('Y');
$next_month = date('m', strtotime($next_month_date));
$next_year = date('Y', strtotime($next_month_date));

    $upcoming_movies = get_posts( array( 
        'numberposts'	=> 10,
        'post_type'		=> 'movie',
        'meta_key'      => 'release_date',
        'order'         => 'DESC',
        'orderby'       => 'meta_value',
        'meta_query' => array(
            'relation'		=> 'OR',
            array(
                'key'      => 'release_date',
                'compare'  => 'REGEXP',
                'value'    => $next_year. '-' . $next_month . '-[0-9]{2}',
            ), 
            array(
                'key'      => 'release_date',
                'compare'  => 'REGEXP',
                'value'    => $current_year. '-' . $current_month . '-[0-9]{2}',
            ), 
        )
    ) );
?>

<div class="container mt-4 mb-3">
    <h2 class="mb-3 ml-2">Upcoming Movies</h2>
    <?php if( count( $upcoming_movies) ) { ?>
        <div class="grid-container">
            <?php 
                foreach( $upcoming_movies as $movie ) { 
                setup_postdata( $movie );

            ?>
            <div class="align-items-stretch d-flex mx-2 mb-4">
                <?php get_template_part( 'template-parts/movies/movie-card', null, $movie->ID ); ?>
            </div>
            <?php	
                }
	            wp_reset_postdata();
            ?>
        </div>
    <?php } ?>
</div>