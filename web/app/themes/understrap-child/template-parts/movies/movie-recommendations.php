<section class="py-5 px-3 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">recommendations</h2>
        <?php if( have_rows('recommendations') ): ?>
            <div class="grid-container">
                <?php 
                    while( have_rows('recommendations') ) : the_row();
                        $r_movie_slug = get_sub_field('movie_slug');
                        $r_movie = get_page_by_path( $r_movie_slug, OBJECT, 'movie' );
                        if( $r_movie ) :
                            $r_movie_id = $r_movie->ID; ?>
                            <div class="align-items-stretch d-flex mx-2 mb-4">
                                <?php get_template_part( 'template-parts/movies/movie-card', null, $r_movie_id ); ?>
                            </div>
                        <?php endif;
                    endwhile; 
                    ?>
            </div>
        <?php endif;?>
    </div>
</section>