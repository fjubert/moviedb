<?php
$popular_actors = get_posts( array( 
    'numberposts'	=> 10,
    'post_type'		=> 'actor',
    'meta_key'      => 'actor_popularity',
    'order'         => 'DESC',
    'orderby'       => 'meta_value_num'
) );
?>

<div class="container mb-3">
    <h2 class="mb-3 ml-2">Most Popular Actors</h2>
    <?php if( count( $popular_actors ) ) { ?>
        <div class="grid-container">
            <?php 
                foreach( $popular_actors as $actor ) { 
                setup_postdata( $actor );

            ?>
            <div class="align-items-stretch d-flex mx-2 mb-4">
                <?php get_template_part( 'template-parts/actors/actor-card', null, $actor->ID ); ?>
            </div>
            <?php	
                }
	            wp_reset_postdata();
            ?>
        </div>
    <?php } ?>
</div>
