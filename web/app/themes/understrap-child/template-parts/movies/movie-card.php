<?php
    $movie_id = $args;
    $movie_permalink = get_the_permalink($movie_id);
    $movie_title = get_the_title($movie_id);
    $movie_poster = get_field('movie_poster', $movie_id);
    $release_date_field = get_field('release_date', $movie_id);
    $release_date = date("M d, Y", strtotime($release_date_field));
    $genre = wp_get_object_terms( $movie_id, 'movie_genre', array( 'fields' => 'names' ) );
    $genre_name = array_shift($genre);
?>
<a href="<?php echo $movie_permalink;?>" class="card movie-card shadow-sm border-0">
    <img src="<?php echo $movie_poster;?>" class="card-img-top" alt="movie poster">
    <span class="badge rounded-pill bg-dark genre-pill text-light"><?php echo $genre_name ?></span>
    <div class="card-body">
        <h5><?php echo $movie_title;?></h5>
        <p class="card-text"><?php echo $release_date ?></p>
    </div>
</a>