<?php
    $actor_id = $args;
    $actor_permalink = get_the_permalink($actor_id);
    $actor_title = get_the_title($actor_id);
    $actor_profile = get_field('profile_picture', $actor_id);
    $popularity = get_field('actor_popularity', $actor_id);
    if( $actor_profile === 'https://image.tmdb.org/t/p/h632' ) {
        $actor_profile = 'https://storage.googleapis.com/stsfloors-app/2021/11/ef8d001c-profile.jpg';
    }
?>

<a href="<?php echo $actor_permalink;?>" class="card movie-card shadow-sm border-0">
    <img src="<?php echo $actor_profile; ?>" class="card-img-top" alt="actor profile picture">
    <div class="card-body">
        <h5><?php echo $actor_title; ?></h5>
    </div>
</a>