<?php
    $actor_name = get_field('actor_name');
    $profile_picture = get_field('profile_picture');
    if($profile_picture === 'https://image.tmdb.org/t/p/h632') {
        $profile_picture = 'https://storage.googleapis.com/stsfloors-app/2021/11/ef8d001c-profile.jpg'; 
    } 
    $birthday = get_field('actor_birthday');
    $place_of_birth = get_field('actor_place_of_birth');
    $day_of_death = get_field('actor_day_of_death');
    $popularity = get_field('actor_popularity');
    $bio = get_field('actor_bio');
    $actor_gallery = get_field('actor_gallery');
?>

<section class="px-3">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <img src="<?php echo $profile_picture; ?>" alt="<?php echo $actor_name; ?>" class="rounded">
                <div class="px-3 pt-4">
                    <h3>Personal Info</h3>
                    <h5>Birthday</h5>
                    <p><?php echo $birthday; ?></p>
                    <h5>Place of Birth</h5>
                    <p><?php echo $place_of_birth; ?></p>
                    <?php if($day_of_death) { ?>
                        <h5>Date of Death</h5>
                        <p><?php echo $day_of_death; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <h1><?php echo $actor_name; ?></h1>
                <h4>Biography</h4>
                <p><?php echo $bio; ?></p>
                <?php get_template_part('template-parts/actors/actors-know-for'); ?>
            </div>
        </div>
    </div>
</section>