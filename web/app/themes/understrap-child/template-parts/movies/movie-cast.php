<?php
    $cast = get_field('cast', );
    $c = 0;
    if( $cast ): ?>
        <div id="movie-cast">
            <h2 class="mb-3 ml-2">Cast</h2>
            <div class="grid-container">
            <?php foreach( $cast as $actor ): 
                setup_postdata($actor); ?>
                <div class="align-items-stretch d-flex mx-2 mb-4">
                    <?php get_template_part('template-parts/actors/actor-card', null, $actor); ?>
                </div>
                <?php 
                    if($c >= 5) {
                        break;
                    }
                    $c++;
                endforeach; 
                ?>
            </div>
        </div>
        <?php 
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); ?>
    <?php endif; ?>