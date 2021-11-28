<?php 
while ( have_posts() ) : the_post();
    get_template_part('template-parts/movies/movie-hero'); ?>
    <div class="container py-5 px-3">
        <div class="row">
            <div class="col-12 col-md-8">
                <?php 
                    get_template_part('template-parts/movies/movie-cast'); 
                    get_template_part('template-parts/movies/movie-production-companies');
                    get_template_part('template-parts/movies/movie-reviews');
                ?>
            </div>
            <div class="col-12 col-md-4">
                <?php get_template_part('template-parts/movies/movie-sidebar'); ?>            </div>
        </div>
    </div>
    <div class="container py-5 px-3">
        <?php get_template_part('template-parts/movies/movie-recommendations'); ?>
    </div>


<?php endwhile; ?>