<?php
    $movie_title = get_the_title();
    $movie_poster = get_field('movie_poster');
    $movie_trailer = get_field('movie_trailer');
    $overview = get_field('overview');
    $original_language = get_field('original_language');
    $popularity = get_field('popularity');
    $release_date_field = get_field('release_date');
    $release_date = date("m/d/Y", strtotime($release_date_field));
    $genres = wp_get_object_terms( get_the_ID() , 'movie_genre', array( 'fields' => 'names' ) );
    $genres_display = implode(", ",$genres);
?>

<section class="py-5 px-3 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <img 
                    src="<?php echo $movie_poster; ?>" 
                    class="img-fluid rounded" 
                    alt="..." 
                />
            </div>
            <div class="col-12 col-md-8">
                <h1 class="mt-3"><?php echo $movie_title; ?></h1>
                <div class="movie-info mb-3">
                    <span><?php echo $release_date; ?></span>
                    <span>•</span>
                    <span><?php echo $genres_display; ?></span>
                    <span>•</span>
                    <span><b>Popularity: </b><?php echo $popularity; ?></span>
                </div>
                <?php if($movie_trailer) { ?>
                    <a href="<?php echo $movie_trailer; ?>" target="_blank" >
                        <button type="button" class="btn mb-3 btn-primary">Play Trailer</button>
                    </a>
                <?php } ?>
                <div class="overview">
                    <h4>Overview</h4>
                    <p><?php echo $overview; ?></p>
                    <p><b>Original Language:</b><span style="text-transform: uppercase;"> <?php echo $original_language ;?></span></p>
                </div>
            </div>
        </div>
    </div>
</section>