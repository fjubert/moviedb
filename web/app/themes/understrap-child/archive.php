<?php
/* 
Template Name: Archives
*/
get_header(); ?>
 
<div id="primary" class="site-content">
    <div id="content" role="main">
        <div class="container"> 
            <h1 class="mb-4 mt-4"><?php the_archive_title(); ?></h1>
            <div class="grid-container">
                <?php while ( have_posts() ) : the_post();
                    $post_id = get_the_ID();
                    if(is_post_type_archive('movie')) { ?>
                        <div class="align-items-stretch d-flex mx-2 mb-4">
                            <?php get_template_part('template-parts/movies/movie-card', $post_id ); ?>
                        </div>
                    <?php 
                    } 
                    if(is_post_type_archive('actor')) { ?>
                        <div class="align-items-stretch d-flex mx-2 mb-4">
                            <?php get_template_part('template-parts/actors/actor-card', $post_id ); ?>
                        </div>
                    <?php 
                    }
                endwhile; // end of the loop. ?>  
            </div>
            <?php understrap_pagination(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>